<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table    = 'notifications';
    public $timestamps  = true;
    protected $fillable = [
        'uid',
        'code',
        'type',
        'permanent',
        'message',
        'template',
        'created_at',
        'updated_at',
    ];

}
