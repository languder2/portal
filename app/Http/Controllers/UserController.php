<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class UserController extends Controller
{
    public function test():string
    {
        return view("test",[
            "authStatus"    => (bool)auth()->check(),
            "user"          => auth()->user(),
        ]);
    }

    public function login(Request $request): JsonResponse|string
    {

        $validated =    $request->validateWithBag("login", [
            "form.email" => "required|email|",
            "form.password" => "required"
        ]);

        $form = $request->post("form");

        dd($form);

        return "123";
    }
}
