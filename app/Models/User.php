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

    public static function createPassword($user,$length = 12):string
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

        do{
            $pass= "";
            for($i=1;$i<=$length;$i++){
                $symbolSet = $symbols[$symbolsTypes[rand(0,2)]];

                $pass.= $symbolSet[rand(0,strlen($symbolSet)-1)];

                if($i%3 ===0 and $i!=$length)
                    $pass.= "-";
            }
        }
        while(preg_match('^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$^', $pass));


        $user->password = bcrypt($pass);
        $user->save();

        return $pass;
    }

}
