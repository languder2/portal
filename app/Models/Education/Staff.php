<?php

namespace App\Models\Education;

use App\Models\Notification;
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
        'status',
        'comment',
        'template',
        'confirmed_at',
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
            self::setRole($uid);
        else{
            Role::deleteRole($uid,'staff');
            Notification::where('uid',$uid)
                ->where('code' ,'LIKE','role:staff:*')
                ->delete();
        }

    }

    public static function setRole(?int $uid = null):void
    {
        if(is_null($uid))
            $uid        = auth()->id();

        $user           = User::find($uid);

        if(Role::checkUserRole($uid,'staff') === false)
            Notification::updateOrCreate(
                [
                    'code'      => 'role:staff:created',
                    'uid'       => $uid,
                ],
                [
                    'type'          => 'success',
                    'permanent'     => 'no',
                    'lifetime'      => now()->addHour(),
                    'message'       => json_encode(
                        [
                            'email'         =>  $user->email
                        ],
                        JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT
                    ),
                    'template'      => 'notifications.roles.staff-created'
                ]
            );

        Role::setRole($uid,'staff');
    }

}

//'Заявка на получения роли сотрудника отправлена.<br>О подтверждении роли Вы будете уведомлены письмом'
