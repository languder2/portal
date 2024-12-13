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
        'status',
        'comment',
        'template',
        'confirmed_at',
    ];

    public static function getRoleByCode(string $role):object
    {
        return DB::table('roles')->where('code',$role)->first();
    }
    public static function setRole(?int $uid = null,$role):void
    {
        if(is_null($uid))
            $uid = auth()->id();

        $role   = self::getRoleByCode($role);

        self::updateOrCreate(
            [
                'uid'       => $uid,
                'rid'       => $role->id,
            ]
        );
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
    public static function getUserRoles(int $uid = null,?string $status = null):object|array
    {


        $response       = (object)[
            'created'   => [],
            'confirmed' => [],
            'failed'    => [],
            'all'       => []
        ];

        if(!is_null($status))
            if(!isset($response->{$status}))
                return [];

        if(is_null($uid))
            $uid        = auth()->id();

        $roles          = Role::where('uid',$uid)
            ->join('roles','role_assigned.rid','=','roles.id')
            ->select('role_assigned.*','roles.code','roles.name')
            ->get();

        foreach($roles->all() as $role){
            $response->{$role->status}[$role->code] = $role;
            $response->all[$role->code] = $role;
        }

        return is_null($status)?$response:$response->{$status};
    }

    public static function getUserRolesNames(int $uid = null):object
    {
        $response = (object)[];

        $list = self::getUserRoles($uid);

        foreach($list as $type=>$roles)
            $response->{$type} = array_map(function($role){
                    return $role->name;
                },$roles??[]);

        return $response;
    }

    public static function checkUserRole(int $uid,string $role,bool $confirmed = false):bool
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
