<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\{Notification, Token, User, Role, UserDetail};
use App\Models\Education\{Faculty,Department,Level,Form,Speciality,Student,Staff};

use Illuminate\Http\{JsonResponse,RedirectResponse,Request};
use Illuminate\Support\{Carbon,Str,Facades\Session};
use Illuminate\View\View;

class AccountController extends Controller
{
    protected ?User $user;
    protected ?UserDetail $detail;

    public function __construct()
    {
        if(auth()->check()){
            $this->user = User::find(auth()->user()->getAuthIdentifier());

            $this->detail     = UserDetail::where('uid',$this->user->id)->first();

            if($this->detail === null)
                $this->detail         = UserDetail::create([
                    'uid'               => $this->user->id,
                ]);
        }
    }

    public function auth(Request $request): JsonResponse|string|RedirectResponse
    {

        $validation = $request->validate(
            [
                "form.email"                => "required|email",
                "form.password"             => 'required',
                "form.remember"             => "",
            ],
            [
                'form.password.required'    => 'Укажите пароль',
            ]
        );

        $form = (object)$validation['form'];


        $user = User::where("email",$form->email)->first();

        if(is_null($user))
            return redirect()->back()->withInput()->withErrors([
                "msg"   => view("messages.account.user-not-found")->render()
            ]);

        if(!password_verify($validation['form']['password'],$user->password))
            return redirect()->back()->withInput()->withErrors([
                "msg"   => view("messages.account.user-invalid-password")->render()
            ]);


        auth()->login($user,isset($form->remember));
        return redirect(route("account"));
    }
    public function changePassword(Request $request)
    {

        /* Get user */

        if(Session::exists("ChangePassAvailable"))
            $user = User::where("email",Session::get("ChangePassAvailable"))->first();

        elseif(auth()->check())
            $user = auth()->user();

        else
            return redirect(route("home"));


        /* Generated Password */

        if($generate = $request->get("passGenerate")){

            $pass = User::createPassword();

            $user->password = bcrypt($pass);
            $user->save();

            SendEmailJob::dispatch((object)[
                "template"      => "emails.account.pass-generated",
                "subject"       => "Восстановление доступа на портале ФГБОУ ВО \"МелГУ\"",
                "user"          => $user,
                "pass"          => $pass
            ]);

            if(!auth()->check())
                Notification::updateOrCreate(
                    [
                        'code'      => 'password:change',
                        'uid'       => $user->id,
                    ],
                    [
                        'type'      => 'success',
                        'message'   => json_encode(['email'=>$user->email],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT),
                        'template'  => 'notifications.account-password-created',
                    ]
                );

            if(auth()->check())
                return redirect(route("account"));

            return redirect()->route("message")->with([
                "message"   =>  view("messages.account.new-pass-generated",[])->render()
            ]);
        }

        /* Set Password */

        $validation = $request->validate(
            [
                "newPass"               => "required|confirmed:newPassConfirm|regex:'^(?=.*[!@#$%&*()_+\-=])(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$'",
            ],
            [
                'newPass.required'      => 'Не указан новый пароль',
                'newPass.confirmed'     => 'Пароль и подтверждение не совпадают',
                'newPass.regex'         => 'Пароль не соответствует требованиям',
            ]
        );

        $user->update([
            "password"  => bcrypt($validation['newPass'])
        ]);

        if(Session::exists("ChangePassAvailable")){
            Session::remove("ChangePassAvailable");

            return redirect()->route("message")->with([
                "message"   =>  view("messages.account.new-pass-save",[])->render()
            ]);

        }

        Notification::updateOrCreate(
            [
                "code"      => "password:change",
                "uid"       => $user->id,
            ],
            [
                "type"      => "success",
                "message"   => "Новый пароль задан",
                'template'  => null,
            ]
        );

        return redirect()->route("account");

    }
    public function emailVerified($token)
    {
        $token  = Token::where('updated_at','>', Carbon::now()->subHours(24))
            ->where([
                'code'      => 'verification:email',
                'token'     => $token,
            ])
            ->first();

        if(is_null($token))
            return redirect()->route("message")->with([
                "message"   => view("messages.account.email-verified-token-invalid")->render()
            ]);

        $user   = User::where("email",$token->email)->first();

        $user->email_verified_at    = Carbon::now();
        $user->save();

        $token->delete();
        Notification::where([
            "code"          => "email:verification required",
            "uid"           => $user->id,
        ])->delete();

        return redirect()->route("message")->with([
            "message"   =>  view("messages.account.email-verified-success",[
            ])->render()
        ]);
    }
    public function page():View|RedirectResponse
    {
        $user           = User::find(auth()->user()->getAuthIdentifier());

        $user->roles    = Role::where("uid",$user->id)->get();


        $sections = [
            "notifications"     => view("sections.public.notifications",
                [
                    "list"          => Notification::getList($user->id),
                ])->render(),

        ];

        return view("pages.public.account",[
            "sections"          => $sections,
        ]);
    }
    public function passRecoveryConfirm($token)
    {
        $token = Token::where("updated_at",">", Carbon::now()->subHours(3))
            ->where(
                [
                    'code'      => 'password:recovery',
                    'token'     => $token,
                ]
            )
            ->first();

        if(is_null($token))
            return redirect()->route("message")->with([
                "message"   => view("messages.account.pass-recovery-invalid-token")->render()
            ]);

        Session::put("ChangePassAvailable",$token->email);

        $token->delete();

        return redirect(route("change-password"));
    }
    public function passRecoveryCreate(Request $request):RedirectResponse|string
    {
        $validation = $request->validate(
            [
                "form.email"                => "required|email",
            ],
            [
                'form.email.required'       => 'Укажите Ваш Email',
            ]
        );

        $form = (object)$validation['form'];

        $user = User::where("email",$form->email)->first();

        if(is_null($user))
            return redirect()->back()->withInput()->withErrors([
                "msg"   => view("messages.account.user-not-found")->render()
            ]);

        do
            $token = Str::random(32);
        while(Token::where("token",$token)->exists());

        Token::updateOrCreate(
            [
                "email"     => $user->email,
            ],
            [
                "token"     => $token,
                "code"      => 'password:recovery'
            ]
        );

        SendEmailJob::dispatch((object)[
            "template"      => "emails.account.pass-recovery",
            "subject"       => "Восстановление доступа на портале ФГБОУ ВО \"МелГУ\"",
            "user"          => $user,
            "token"         => $token
        ]);

        return redirect()->route("message")->with([
            "message"   =>  view("messages.account.pass-recovery-send",[
                "email" => $user->email,
            ])->render()
        ]);
    }
    public function registration(Request $request)
    {

        User::where("email",$request->get("email"))->delete();

        $rules          = [
            "password"              => "required|confirmed:confirm|regex:'^(?=.*[!@#$%&*()_+\-=])(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$'",
            "email"                 => "required|unique:users,email|regex:'^[a-zA-Z0-9_.+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,6}$'",
            "lastname"              => 'required',
            "firstname"             => 'required',
            "middlename"            => "",
        ];

        $messages       = [
            'password.regex'        => 'Пароль не соответствует требованиям',
            'email.required'        => 'E-mail не указан',
            'email.regex'           => 'E-mail указан не корректно',
            'email.unique'          => 'E-mail уже занят',
            'lastname.required'     => 'Фамилия не указана',
            'firstname.required'    => 'Имя не указано',
            'password.required'     => 'Не указан новый пароль',
            'password.confirmed'    => 'Пароль и подтверждение не совпадают',
        ];

        if(request()->exists("passGenerate")){
            $pass = User::createPassword();
            unset($rules['password']);
        }

        $form = (object)$request->validate($rules,$messages);

        $form->password = bcrypt($pass??$form->password);

        $user = User::create((array)$form);

        User::sendEmailVerification($user,$pass??null);

        return redirect()->route("message")->with([
            "message"   =>  view("messages.account.registration-success",[
                "email" => $user->email,
                "pass"  => &$pass,
                "date"  => Carbon::now( 'Europe/Moscow')->addHours(24)->format('d.m.Y H:i:s')
            ])->render()
        ]);
    }
    public function resendEmailVerification():RedirectResponse
    {
        $user =  User::find(auth()->user()->getAuthIdentifier());

        Notification::create([
            'uid'               => $user->id,
            'type'              => 'success',
            'permanent'         => 'no',
            'message'           => $user->email,
            'template'          => '',
        ]);
        return redirect()->back();
    }

    public function savePersonalBase(Request $request):RedirectResponse
    {
        $userForm = $request->validate([
            "lastname"              => 'required',
            "firstname"             => 'required',
            "middlename"            => "",
            "email"                 => "required|unique:users,email,{$this->user->id}|regex:'^[a-zA-Z0-9_.+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,6}$'",
        ]);

        $detailForm = $request->validate([
            'phone'                 => "",
            'sex'                   => "",
            'birthday'              => ""
        ]);

        if($this->user->email !== $userForm['email']){
            $this->user->update([
                'email'             => $userForm['email']
            ]);

            User::sendEmailVerification($this->user,null,'change:email');
        }

        $this->user->update($userForm);

        $this->detail->update($detailForm);

        Notification::updateOrCreate(
            [
                'code'      => 'save:personal-base',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => 'Персональные данные сохранены',
            ]
        );

        return redirect()->route('show:personal');
    }
    public function savePersonalIdentification(Request $request):RedirectResponse
    {

        $rules      = [
            'snils'                     => "unique:users_details,snils,{$this->detail->id}|required|regex:'^[0-9]{3}\-[0-9]{3}\-[0-9]{3} [0-9]{2}'",
            'inn'                       => "",
            'citizenship'               => "",
            'document_type'             => "",
            'document_serial'           => "",
            'document_number'           => "",
            'document_issue_date'       => "",
            'document_issue_whom'       => "",
            'document_issue_whom_code'  => "regex:'^[0-9]{3}\-[0-9]{3}'|nullable",
        ];

        $messages   = [
            'snils.unique'              => 'Указанный СНИЛС уже есть в Нашей базе',
            'snils.required'            => 'Поле СНИЛС обязательно к заполнению',
            'snils.regex'               => 'Поле СНИЛС должно быть заполнено в формате: <b>000-000-000 00</b>',
            'document_issue_whom_code.reqex'
                            => 'Код подразделения выдавшего документа быть заполнено в формате: <b>000-000</b>',
        ];

        $detailForm = $request->validate($rules,$messages);


        $this->detail->update($detailForm);

        Notification::updateOrCreate(
            [
                'code'      => 'save:personal-identification',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => 'Паспортные данные сохранены',
            ]
        );

        return redirect()->route('show:personal');
    }

    public function saveEducation(Request $request):RedirectResponse|string
    {

        if($request->get('id')){

            $student = Student::where([
                'id'            => $request->get('id'),
                'uid'           => auth()->user()->getAuthIdentifier()
            ])->first();

            if(is_null($student))
                return redirect()->route('show:education');
        }

        if($this->detail->snils === null){
            $rules      = [
                'snils'             => "required|regex:'^[0-9]{3}\-[0-9]{3}\-[0-9]{3} [0-9]{2}'",
            ];

            $messages   = [
                'snils.required'    => 'Поле СНИЛС обязательно к заполнению',
                'snils.regex'       => 'Поле СНИЛС должно быть заполнено в формате: <b>000-000-000 00</b>',
            ];

            $form = $request->validate($rules,$messages);

            $this->detail->update($form);
        }

        $rules          = [
            'faculty'               => 'required',
            'department'            => 'required',
            'level'                 => 'required',
            'form'                  => 'required',
            'speciality'            => 'required',
            'course'                => 'required',
            'group_number'          => 'required',
            'contract_number'       => '',
            'year_from'             => 'nullable|numeric',
            'year_to'               => "nullable|numeric|min:{$request->year_from}",
        ];

        $messages       = [
            'faculty'               => 'Укажите факультет',
            'department'            => 'Укажите кафедру',
            'level'                 => 'Укажите уровень',
            'form'                  => 'Укажите форму обучения',
            'speciality'            => 'Укажите специальность',
            'course'                => 'Укажите курс',
            'group_number'          => 'Укажите номер группы',
            'year_to.min'           => "Год окончания не может быть меньше года начала обучения",
        ];

        $form = $request->validate($rules,$messages);

        if(!isset($student))
            $student = Student::create([
                'uid'       => $this->user->id,
            ]);

        $student->update($form);

        Notification::updateOrCreate(
            [
                'code'      => 'save:education',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => 'Учебные данные сохранены',
            ]
        );

        Student::updatingRole($this->user->id);

        return redirect()->route('show:education');
    }

    public function deleteEducation(int $id):RedirectResponse
    {

        $student = Student::where([
            'id'            => $id,
            'uid'           => auth()->user()->getAuthIdentifier()
        ])->first();

        if(is_null($student))
            return redirect()->route('show:education');

        $speciality         = Speciality::find($student->speciality);

        Notification::updateOrCreate(
            [
                'code'      => 'delete:education:',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => "Учебные данные удалены: {$speciality->code} {$speciality->name}",
            ]
        );

        $student->delete();

        Student::updatingRole($this->user->id);

        return redirect()->route('show:education');
    }

    public function saveStaff(Request $request):RedirectResponse
    {
        if($request->get('id')){

            $staff = Staff::where([
                'id'            => $request->get('id'),
                'uid'           => auth()->user()->getAuthIdentifier()
            ])->first();

            if(is_null($staff))
                return redirect()->route('show:education');
        }

        $rules          = [
            'ed_faculty'            => '',
            'ed_department'         => '',
            'department'            => '',
            'post'                  => 'required',
            'employment'            => 'nullable|date_format:Y-m-d',
            'dismissal'             => "nullable|date_format:Y-m-d",
        ];

        $messages       = [
            'post'                  => 'Укажите должность',
            'dismissal.min'         => "Дата увольнение не может быть позже даты трудоустройства",
        ];

        $form = $request->validate($rules,$messages);

        if(!isset($staff))
            $staff = Staff::create([
                'uid'       => $this->user->id,
            ]);

        $staff->update($form);

        $checkRole          = Role::checkUserRole($this->user->id,'staff');


        Notification::updateOrCreate(
            [
                'code'      => 'save:staff',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'permanent' => $checkRole?'no':'yes',
                'message'   =>
                    $checkRole
                        ?'Данные о трудоустройстве сохранены'
                        :'Заявка на получения роли сотрудника отправлена.<br>О подтверждении роли Вы будете уведомлены письмом'
                    ,
            ]
        );

        return redirect()->route($checkRole?'show:staff':'account');
    }
}
