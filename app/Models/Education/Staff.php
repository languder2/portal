<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Role;

class Staff extends User
{
    use SoftDeletes;

    protected $table = 'staffs';

    protected $fillable = [
        'id',
        'uid',
        'ed_faculty',
        'ed_department',
        'department',
        'post',
        'employment',
        'dismissal',
    ];

}
