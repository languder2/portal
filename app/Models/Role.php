<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Role extends Model
{
    protected $table = 'role_assigned';
    public $timestamps = true;
    protected $fillable = [
        'uid',
        'rid',
    ];

    public static function getRoleList()
    {
        return DB::table('roles')->get();
    }
}
