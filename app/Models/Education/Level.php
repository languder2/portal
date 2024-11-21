<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'ed_levels';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'sort',
    ];
}
