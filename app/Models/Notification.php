<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Collection};
use function Laravel\Prompts\table;

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
        'lifetime',
    ];

    public static function getList(?int $uid =  null):Collection
    {

        if(is_null($uid))
            $uid        = auth()->id();

        $list  = Notification::where("uid",$uid)
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

        foreach ($list as $item)
            if ($item->template !== null and view()->exists($item->template))
                $item->message = view($item->template, [
                        'data' => json_decode($item->message)
                    ])->render();

        Notification::where([
            'uid'           => $uid,
            'permanent'     => 'no',
        ])->whereNull('lifetime')->delete();

        return $list;
    }

}
