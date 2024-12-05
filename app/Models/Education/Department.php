<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\{Model, Collection};

class Department extends Base
{
    protected $table = 'ed_departments';

    protected $fillable = [
        'id',
        'name',
        'faculty',
        'sort',
        'created_at',
        'updated_at',
    ];
}
