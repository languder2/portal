<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faculty extends model
{
    use HasFactory, Notifiable;

    protected $table = 'ed_faculties';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'sort',
    ];
    //
}
