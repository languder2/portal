<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public static function getListForSelect(
        ?array $dependents = null,
        string|array $value = 'name',
        string $id = 'id',
    ):object
    {
        $request = (object)[
            'options'       => [],
            'data'          => [],
            'dependents'    => $dependents??[]
        ];


        $list = self::orderBy('sort', 'asc')->orderBy('name','asc')->get();

        foreach ($list as $item) {

            $request->options[$item->{$id}] = '';

            if(is_array($value))
                foreach ($value as $filed)
                    $request->options[$item->{$id}].= $item->{$filed}??$filed;

            else
                $request->options[$item->{$id}] = $item->{$value};

            if(is_array($dependents))
                foreach ($dependents as $dependent)
                    if(isset($item->{$dependent}))
                        $request->data[$item->{$id}][$dependent] = $item->{$dependent};
        }

        return $request;
    }
}
