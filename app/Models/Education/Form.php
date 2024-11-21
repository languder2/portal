<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'ed_forms';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'sort',
    ];
}
