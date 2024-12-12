<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Role;

class Student extends User
{
    use SoftDeletes;

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


    public static function getList(int $uid = null)
    {

        if(is_null($uid))
            $uid    = auth()->id();

        return self::where('uid',$uid)
            ->join('ed_faculties','ed_faculties.id','=','students.faculty')
            ->join('ed_departments','ed_departments.id','=','students.department')
            ->join('ed_forms','ed_forms.id','=','students.form')
            ->join('ed_levels','ed_levels.id','=','students.level')
            ->join('ed_specialities','ed_specialities.id','=','students.speciality')
            ->select(
                'students.*',
                'ed_faculties.name as faculty',
                'ed_departments.name as department',
                'ed_forms.name as form',
                'ed_levels.name as level',
                'ed_specialities.code as code',
                'ed_specialities.name as speciality',
            )
            ->orderBy('year_from','desc')
            ->orderBy('students.id','desc')
            ->get();
    }

    public static function updatingRole(int $uid): void
    {
        if(self::where('uid',$uid)->exists())
            Role::setRole($uid,'student');

        else
            Role::deleteRole($uid,'student');
    }
}
