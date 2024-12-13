<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\SendEmailJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'firstname',
        'middlename',
        'lastname',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function createPassword($length = 12):string
    {
        $symbolsTypes       =[
            "lowercase","uppercase","numbers"
        ];
        $symbols            = [
            "lowercase"          => 'abcdefghjkmnpqrstuvwxyz',
            "uppercase"          => 'ABCDEFGHJKMNPQRSTUVWXYZ',
            "numbers"            => '123456789',
            "specialChars"       => '!@#$%^&*',
        ];

        $pass = self::getSymbol($symbols['uppercase']);
        $pass.= self::getSymbol($symbols['lowercase']);
        $pass.= self::getSymbol($symbols['numbers']);

        for($i=0;$i<$length-3;$i++){
            if($i%3 === 0) $pass.= "-";

            $pass.= self::getSymbol($symbols[$symbolsTypes[rand(0,2)]]);
        }

        return $pass;
    }

    public static function getSymbol($string):string
    {
        return $string[rand(0,strlen($string)-1)];
    }

    public static function sendEmailVerification(
        User $user,
        ?string $pass =  null,
        ?string $type = 'registration'
    ):bool
    {
        do
            $token = Str::random(32);
        while(Token::where('token',$token)->exists());

        $user->update([
            'email_verified_at'     => null
        ]);

        Token::updateOrCreate(
            [
                'email'     => $user->email,
                'code'      => 'verification:email'
            ],
            [
                'token'     => $token,
                'email'     => $user->email,
                'lifetime'  => now()->addDay(3)
            ]
        );

        $tempalte = match ($type) {
            'registration'  => 'emails.account.registration',
            'change:email'  => 'emails.account.change-email',
            default         => null,
        };

        if(!is_null($tempalte))
            SendEmailJob::dispatch((object)[
                "template"          => $tempalte,
                "subject"           => "Регистрация на портале ФГБОУ ВО \"МелГУ\"",
                "user"              => $user,
                "pass"              => &$pass,
                "token"             => $token,
                "date"              => Carbon::now( 'Europe/Moscow')
                                            ->addHours(24)->format('d.m.Y H:i:s'),
            ]);

        Notification::updateOrCreate(
            [
                "code"          => "email:verification required",
                "uid"           => $user->id,
            ],
            [
                "code"          => "email:verification required",
                "uid"           => $user->id,
                "type"          => 'danger',
                "permanent"     => 'yes',
                "message"       => 'Требуется подтверждение почты',
                "template"      => 'notifications.account-no-verification-email'
            ]
        );

        return true;
    }

}
