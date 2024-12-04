<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Collection};

class Department extends Model
{
    protected $table = 'ed_departments';

    protected $fillable = [
        'id',
        'name',
        'faculty',
        'sort',
        'created_at',
        'updated_at',
    ];
    public static function getListForComponent():object
    {
        $request = (object)[
            'options'   => [],
            'data'      => []
        ];

        $list = Department::orderBy('sort', 'asc')->orderBy('name','asc')->get();

        foreach ($list as $department) {
            $request->options[$department->id] = $department->name;
            $request->data[$department->id] = [
                'faculty'   => $department->faculty,
            ];
        }

        return $request;
    }
}
