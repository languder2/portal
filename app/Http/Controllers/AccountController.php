<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Models\Token;

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

        Token::created([
            "token"     => $token,
            "email"     => $user->email,
            "code"      => "pass-recovery"
        ]);

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

        $record     = DB::table('password_reset_tokens')->where("token",$token)->first();
        dd($token,$record);
    }

    public function page():View
    {
        return view("pages.public.account");
    }


}
