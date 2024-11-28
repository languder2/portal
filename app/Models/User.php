<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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

}
