<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Token;
use App\Models\Notification;


class AccountController extends Controller
{
    public function auth(Request $request): JsonResponse|string|RedirectResponse
    {

        $validation = $request->validate(
            [
                "form.email"                => "required|email",
                "form.password"             => "required",
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
                "email"     => $user->email,
                "code"      => "pass-recovery"
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

    public function passRecoveryConfirm($token)
    {
        $token = Token::where("updated_at",">", Carbon::now()->subHours(3))
            ->where("token",$token)
            ->first();

        if(is_null($token))
            return redirect()->route("message")->with([
                "message"   => view("messages.account.pass-recovery-invalid-token")->render()
            ]);

        Session::put("ChangePassAvailable",$token->email);

        $token->delete();

        return redirect(route("change-password"));
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

            $pass = User::createPassword($user);


            SendEmailJob::dispatch((object)[
                "template"      => "emails.account.pass-recovery",
                "subject"       => "Восстановление доступа на портале ФГБОУ ВО \"МелГУ\"",
                "user"          => $user,
                "token"         => &$token
            ]);

            dd($pass);

            return redirect()->route("message")->with([
                "message"   =>  view("messages.account.new-pass-save",[])->render()
            ]);
        }

        /* Set Password */

        $validation = $request->validate(
            [
                "newPass"               => "required|confirmed:newPassConfirm|regex:'^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$'",
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
                "code"  => "save-password",
                "uid"   => $user->id,
            ],
            [
                "code"      => "save-password",
                "type"      => "success",
                "uid"       => $user->id,
                "message"   => "Новый пароль сохранен"
            ]
        );

        return redirect()->route("account");

    }

    public function passwordGenerate()
    {
        dd("passwordGenerate");
    }

    public function page():View
    {
        return view("pages.public.account");
    }


}
