<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'ed_departments';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'faculty',
        'sort',
    ];
}
