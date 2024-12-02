<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Collection};
class Notification extends Model
{
    protected $table    = 'notifications';
    public $timestamps  = true;
    protected $fillable = [
        'uid',
        'code',
        'type',
        'permanent',
        'message',
        'template',
        'created_at',
        'updated_at',
    ];

    public static function getList($uid):Collection
    {
        $notifications  = Notification::where("uid",$uid)
            ->orderByRaw("

                CASE permanent
                    WHEN 'no'   THEN 1
                    WHEN 'yes'  THEN 2
                    ELSE 3
                END
                , CASE type
                    WHEN 'danger'   THEN 1
                    WHEN 'warning'  THEN 2
                    WHEN 'success'  THEN 3
                    WHEN 'info'     THEN 4
                    ELSE 5
                END
            ")
            ->get();

        foreach ($notifications as $notification) {
            if ($notification->permanent === "no")
                $notification->delete();

            if ($notification->template !== null)
                if (view()->exists($notification->template))
                    $notification->message = view($notification->template, [
                        'data' => json_decode($notification->message)
                    ])->render();
        }

        return $notifications;
    }

}
