<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Student extends User
{
    protected $table = 'students';

    protected $fillable = [
        'id',
        'uid',
        'faculty',
        'department',
        'level',
        'form',
        'speciality',
        'course',
        'group_number',
        'contract_number',
        'speciality',
        'year_from',
        'year_to',
    ];
}
