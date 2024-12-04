<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Collection};

class Faculty extends Model
{
    protected $table = 'ed_faculties';

    protected $fillable = [
        'id',
        'name',
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

        $list = Faculty::orderBy('sort', 'asc')->orderBy('name','asc')->get();

        foreach ($list as $faculty)
            $request->options[$faculty->id] = $faculty->name;

        return $request;
    }
}
