<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faculty extends Base
{
    protected $table = 'ed_faculties';

    protected $fillable = [
        'id',
        'name',
        'sort',
        'created_at',
        'updated_at',
    ];
}
