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
    public static function getRoleByName(string $role):object
    {
        return DB::table('roles')->where('name',$role)->first();
    }
    public static function setRole(int $uid,$role):bool
    {
        $role   = self::getRoleByName($role);
        $role   = Role::firstOrNew(
            [
                'uid'       => $uid,
                'rid'       => $role->id,
            ]
        );

        if(!$role->exists){
            Notification::updateOrCreate(
                [
                    'code'      => 'role:assigment:student',
                    'uid'       => $uid,
                ],
                [
                    'type'      => 'success',
                    'message'   => 'Роль студента ФГБОУ ВО "МелГУ" присвоена',
                ]
            );
            $role->save();
        }
        return true;
    }

    public static function deleteRole(int $uid,$role):void
    {
        $role   = self::getRoleByName($role);
        $role   = Role::where(
            [
                'uid'       => $uid,
                'rid'       => $role->id,
            ]
        )->delete();
    }

}
