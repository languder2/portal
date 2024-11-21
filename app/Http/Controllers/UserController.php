<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function test():string
    {
        return view("test",[
            "authStatus"    => (bool)auth()->check(),
            "user"          => auth()->user(),
        ]);
    }
}
