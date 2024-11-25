<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\View\View;

class TestController extends Controller
{
    public function auth():string
    {
        return "view";
    }

    public function email():string
    {
        Mail::to("languder2@gmail.com")->send(new TestEmail(
            (object)[
                "lastname"      => "Sultan",
                "firstname"     => "Sergey2",
            ]
        ));
        return "email sent";
    }

    public function job():string
    {
        $data = (object)[
            'email'         => 'languder2@gmail.com',
            "lastname"      => "Sultan",
            "firstname"     => "Sergey2",
        ];

        SendEmailJob::dispatch($data);

        return "job create";
    }

    public function redisSet():bool
    {
        return (bool)Redis::set("test","redis test");
    }

    public function redisGet():string
    {
        return Redis::get('test')??"";
    }

    public function sessionSet():string
    {

        Session::flash("flash","session test");
        Session::put("test","session test");

        return "set";
    }
    public function sessionGet():string
    {

        if(Session::has("test"))
            echo "session has test<hr>";

        $test = Session::get("test");
        echo "session has test: {$test}<hr>";

        if(Session::has("test"))
            echo "session has 2 test<hr>";

        if(Session::has("flash"))
            echo "session has flash<hr>";

        $flash = Session::get("flash");
        echo "session has test: {$flash}<hr>";

        if(Session::has("flash"))
            echo "session has 2 flash<hr>";
        else
            echo "not session flash<hr>";

        return "";
    }

    public function test():view
    {

        return view("test",[
            "authStatus"    => (bool)auth()->check(),
            //    "user"          => auth()->user(),
            "user"          => User::find(1),
        ]);
    }


}
