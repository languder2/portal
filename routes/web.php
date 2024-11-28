<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminServiceController;
use Illuminate\Support\Facades\Session;


use App\Models\User;

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


Route::controller(AccountController::class)->prefix("account")->group(function () {
    Route::post("login","auth")->name("auth");

    Route::get("register",function(){return "register";})->name("register");

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
            "form"          => view("account.public.forms.password-change",[]),
            "headTitle"     => 'Портал ФГБОУ ВО "МелГУ": Смена пароля'
        ]);
    })->name("change-password");

    Route::post("change-password","changePassword")->name("change-password-processing");

    Route::get("password/generate","passwordGenerate")->name("password-generate");


    Route::middleware("auth.check")->group(function () {
        Route::get("","page")->name("account");
    });
 });

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

Route::redirect('login', 'account/login');

Route::controller(AuthController::class)->prefix("account")->group(function () {
    Route::view('login',            "login")->name('login');

    Route::get('logout',           function (){
        auth()->logout();
        return redirect("/");
    })->name('logout');
});

Route::controller(AdminServiceController::class)->prefix("as")->group(function () {
    Route::get('truncate/{table}',            "truncate")->name('as.truncate');
});


