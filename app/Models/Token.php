<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table    = 'users_tokens';
    public $timestamps  = true;
    protected $fillable = [
        'email',
        'code',
        'token',
    ];

}