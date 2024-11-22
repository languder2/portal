<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function () {
    Route::get('test', "test");
});

Route::controller(TestController::class)->prefix("test")->group(function () {

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
    Route::view('r',                "404");
});

Route::controller(AdminServiceController::class)->prefix("as")->group(function () {
    Route::get('truncate/{table}',            "truncate")->name('as.truncate');
});

