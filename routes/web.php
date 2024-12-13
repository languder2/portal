<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminServiceController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\{AccountController,StaffController,StudentController};
use App\Models\{Notification,UserDetail,Role};
use App\Models\Education\{Faculty,Department,Form,Level,Speciality,Student,Staff};

Route::get('/', function () {

    if (auth()->check())
        return redirect()->route("account");

    return view("pages.public.account",[
        "form"  => view("account.public.forms.login",[]),
        "headTitle" => 'Портал ФГБОУ ВО "МелГУ": Авторизация'
    ]);
})->name("home");

Route::get("message",function(){

    if(session()->missing('message'))
        return redirect(route("home"));

    return view("pages.public.message",["message" => session('message')]);
})->name("message");

Route::get('logout',           function (){
    auth()->logout();
    return redirect("/");
})->name('logout');


Route::redirect('login', 'account/login');

Route::controller(AccountController::class)->prefix("account")->group(function () {
    Route::post("login","auth")->name("auth");

    Route::view("registration","pages.public.account",[
        "form"              => view("account.public.forms.registration",[]),
        "headTitle"         => 'Портал ФГБОУ ВО "МелГУ": Регистрация'
    ])->name("registration");

    Route::post("registration","registration")->name("registration-processing");

    Route::get("verified/{token}","emailVerified")->name("account.verified");

    Route::view("pass-recovery","pages.public.account",[
        "form"              => view("account.public.forms.password-recovery",[]),
        "headTitle"         => 'Портал ФГБОУ ВО "МелГУ": Восстановление пароля'
    ])->name("pass.recovery");

    Route::post("pass/recovery/create","passRecoveryCreate")->name("pass-recovery-create-token");

    Route::get("pass-recovery/{token}","passRecoveryConfirm")->name("pass.recovery.token");

    Route::get("change-password",function(){

        if(Session::missing("ChangePassAvailable") and !auth()->check())
            return redirect(route("home"));

        return view("pages.public.account",[
            'roles'         => Role::getUserRoles(null,'all'),
            "form"          => view("account.public.forms.password-change",[]),
            "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Смена пароля'
        ]);
    })->name("change-password");

    Route::post("change-password","changePassword")->name("change-password-processing");

    Route::get("password/generate","passwordGenerate")->name("password-generate");
});

Route::middleware("auth.check")
    ->controller(AccountController::class)
    ->prefix("account")
    ->group(function (){
        Route::get('',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(),
                        ])->render(),
                    view('account.public.panel.roles',[
                        'user'          => auth()->user(),
                        'rolesNames'    => Role::getUserRolesNames(),
                        'roles'         => Role::getUserRoles(),
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Аккаунт'
            ]);
        })->name('account');

        Route::get("resend-email-verification","resendEmailVerification")
            ->name("resend-email-verification");

        Route::get('personal',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                    ])->render(),
                    view('account.public.panel.personal-base',[
                        'user'      => auth()->user(),
                        'detail'    => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
                    view('account.public.panel.personal-identification',[
                        'detail'    => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
//                    view('account.public.panel.personal-address',[
//                        'detail'    => UserDetail::where('uid',auth()->id())->first()
//                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Персональные данные'
            ]);
        })->name('show:personal');

        Route::get('change/personal-base',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    view('account.public.forms.personal-base',[
                        'user'      => auth()->user(),
                        'detail'    => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Персональные данные'
            ]);
        })->name('change:personal-base');

        Route::post('save/personal-base','savePersonalBase')->name("save:personal-base");

        Route::get('change/personal-identification',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    view('account.public.forms.personal-identification',[
                        'detail'    => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Персональные данные'
            ]);
        })->name('change:personal-identification');

        Route::post('save/personal-identification','savePersonalIdentification')
            ->name("save:personal-identification");

    });


// Student Actions
Route::middleware("auth.check")
    ->controller(StudentController::class)
    ->prefix("account")
    ->group(function (){
        /* list */
        Route::get('educations',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                        ])->render(),
                    view('account.public.forms.snils',[
                        'uDetail'           => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
                    view('account.public.panel.education-list',[
                        'list'               => Student::getList(),
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Учебные данные'
            ]);
        })->name('show:education');

        /* add */
        Route::get('educations/add',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                        ])->render(),
                    view('account.public.forms.education',[
                        'faculties'         => Faculty::getListForSelect(),
                        'departments'       => Department::getListForSelect(['faculty']),
                        'levels'            => Level::getListForSelect(),
                        'forms'             => Form::getListForSelect(),
                        'specialities'      => Speciality::getListForSelect(['faculty','level'],['code',' ','name']),
                        'uDetail'           => UserDetail::where('uid',auth()->id())->first()
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Добавить учебные данные'
            ]);
        })->name('add:education');

        /* edit */
        Route::get('educations/edit/{id}',function($id){
            $student = Student::where([
                'id'            => $id,
                'uid'           => auth()->id()
            ])->first();

            if(is_null($student))
                return redirect(route('show:education'));

            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                        ])->render(),
                    view('account.public.forms.education',[
                        'faculties'         => Faculty::getListForSelect(),
                        'departments'       => Department::getListForSelect(['faculty']),
                        'levels'            => Level::getListForSelect(),
                        'forms'             => Form::getListForSelect(),
                        'specialities'      => Speciality::getListForSelect(['faculty','level'],['code',' ','name']),
                        'uDetail'           => UserDetail::where('uid',auth()->id())->first(),
                        'student'           => $student
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Добавить учебные данные'
            ]);
        })->name('edit:education');

        /* save */
        Route::post('educations/save','saveEducation')
            ->name("save:education");

        /* delete */
        Route::get('educations/delete/{id}','deleteEducation')
            ->name("delete:education");
    });

// Staff Action
Route::middleware("auth.check")
    ->controller(StaffController::class)
    ->prefix("account")
    ->group(function (){

        /* list */
        Route::get('staff',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                        ])->render(),
                    view('account.public.panel.staff-list',[
                        'list'               => Staff::getList(),
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Учебные данные'
            ]);
        })->name('show:staff');

        /* add */
        Route::get('staff/add',function(){
            return view('pages.public.account',[
                'roles'         => Role::getUserRoles(null,'all'),
                'contents'      => [
                    "notifications"     => view("sections.public.notifications",
                        [
                            "list"          => Notification::getList(auth()->id()),
                        ])->render(),
                    view('account.public.forms.staff',[
                        'faculties'         => Faculty::getListForSelect(),
                        'departments'       => Department::getListForSelect(['faculty']),
                    ])->render(),
                ],
                "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Добавить данные о трудоустройстве'
            ]);
        })->name('add:staff');

        /* save */
        Route::post('staff/save','saveStaff')
            ->name("save:staff");

        /* delete */
        Route::get('staff/delete/{id}','deleteStaff')
            ->name("staff:delete");
    });

// Staff End



Route::controller(TestController::class)->prefix("test")->group(function () {
    Route::get('',                  "test");
    Route::get("redis/set",         "redisSet");
    Route::get("redis/get",         "redisGet");
    Route::get("session/set",       "sessionSet");
    Route::get("session/get",       "sessionGet");
    Route::get("job",               "job");
    Route::get("email",             "email");
    Route::get("user/login",             function (){
        auth()->loginUsingId(1);
    });
    Route::get("user/get",              function (){
        return dump(auth()->user());
    });
});


Route::controller(AdminServiceController::class)->prefix("as")->group(function () {
    Route::get('truncate/{table}',            "truncate")->name('as.truncate');
});


Route::view('under-construction','pages.public.under-construction')->name('under-construction');
Route::view('admin','pages.public.under-construction')->name('admin');
