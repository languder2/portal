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

        $request->validate(
            [
                "form.email"                => "required|email",
                "form.password"             => "required",
            ],
            [
                'form.password.required'    => 'Укажите пароль',
            ]
        );

        $form = $request->post("form");

        $user = User::where("email",$form["email"])->first();

        $error = new MessageBag;
        $error->add("test",view("messages.user-not-found"));


        echo view("messages.user-not-found")->render();

        if(is_null($user))
            return redirect()->back()->withInput()->withErrors([
                "msg"   => view("messages.user-not-found")->render()
            ]);



        $errors = new MessageBag;

        $errors->add("errorTest","3123");

        return redirect()->back()->withErrors($errors);
    }
}
