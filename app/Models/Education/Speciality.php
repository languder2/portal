<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Base
{
    protected $table = 'ed_specialities';
    public $timestamps = true;
    protected $fillable = [
        'name',
        "faculty",
        "department",
        "level",
        "specialty",
        'sort',
    ];
}
