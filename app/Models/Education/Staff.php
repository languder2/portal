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


    public static function getList(int $uid = null)
    {
        if(is_null($uid))
            $uid    = auth()->id();

        return self::where('uid',$uid)
            ->join('ed_faculties','ed_faculties.id','=','staffs.ed_faculty')
            ->join('ed_departments','ed_departments.id','=','staffs.ed_department')
            ->select(
                'staffs.*',
                'ed_faculties.name as ed_faculty',
                'ed_departments.name as ed_department',
            )
            ->orderBy('employment','desc')
            ->get();
    }

    public static function updatingRole(int $uid): void
    {
        if(self::where('uid',$uid)->exists())
            Role::setRole($uid,'staff');

        else
            Role::deleteRole($uid,'staff');
    }

}
