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
        'confirmed_at'
    ];

    public static function getRoleByCode(string $role):object
    {
        return DB::table('roles')->where('code',$role)->first();
    }
    public static function setRole(int $uid,$role):bool
    {
        $role   = self::getRoleByCode($role);
        $role   = self::firstOrNew(
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
        $role   = self::getRoleByCode($role);
        $role   = Role::where(
            [
                'uid'       => $uid,
                'rid'       => $role->id,
            ]
        )->delete();
    }
    public static function getUserRoles(int $uid = null):object
    {
        if(is_null($uid))
            $uid        = auth()->user()->getAuthIdentifier();

        $roles          = Role::where('uid',$uid)
            ->join('roles','role_assigned.rid','=','roles.id')
            ->select('role_assigned.*','roles.code','roles.name')
            ->get();

        $response       = (object)[
            'confirmed' => [],
            'waiting'   => [],
            'failed'   => [],
        ];

        foreach($roles->all() as $role)

            $response[$role->code] = $role;

        return $response;
    }

    public static function getUserRolesNames(int $uid):array
    {
        return array_map(function($role){
            return $role->name;
        },self::getUserRoles($uid));
    }

    public static function checkUserRole(int $uid,string $role,bool $confirmed = true):bool
    {
        $role   = self::getRoleByCode($role);

        $roles  = self::where([
            'uid'       => $uid,
            'rid'       => $role->id,
        ]);

        if($confirmed)
            $roles->whereNotNull('confirmed_at');

        return $roles->exists();
    }

}
