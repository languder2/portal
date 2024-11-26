<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use App\Models\User;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    public function test():string
    {
        return view("test",[
            "authStatus"    => (bool)auth()->check(),
            "user"          => auth()->user(),
        ]);
    }

    public function login(Request $request): JsonResponse|string|RedirectResponse
    {

        $validation = $request->validate(
            [
                "form.email"                => "required|email",
                "form.password"             => "required",
            ],
            [
                'form.password.required'    => 'Укажите пароль',
            ]
        );

        $user = User::where("email",$validation['form']['email'])->first();

        if(is_null($user))
            return redirect()->back()->withInput()->withErrors([
                "msg"   => view("messages.user-not-found")->render()
            ]);


        dump($user->password);
        dump($validation['form']['password']);



        dd();

        return redirect()->back()->withInput()->withErrors([
            "msg"   => view("messages.user-invalid-password")->render()
        ]);
    }
}
