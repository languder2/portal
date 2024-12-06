<label
    for         = "{{@$id}}"
    class       = "sr-only"
>
    {{@$label}}
</label>
<select
    id          = "{{@$id}}"
    name        = "{{@$name}}"
    class="
            block py-2.5 px-0 w-full
            text-sm text-gray-500
            bg-transparent border-0 border-b-2 border-gray-300
            appearance-none
            dark:text-gray-400 dark:border-gray-700
            focus:outline-none focus:ring-0 focus:border-gray-200
            peer
            mb-4
            {{@$class}}
        "


    @disabled(@$disabled)
    @required(@$required)

    @if(!empty($datas) && is_array($datas))
        @foreach($datas as $code=>$data)
            data-{{$code}}="{{$data}}"
        @endforeach
    @endif

    @if(isset($dependents) and is_array($dependents))
        data-dependents='{!! json_encode($dependents) !!}'
    @endif
>

    @if(isset($null))
        <option
            value=''
            disabled
            @selected(empty($old) && empty($value))
        >
            {{$null}}@if(isset($required))* @endif
        </option>
    @endif
    @foreach($list as $code=>$item)
        <option
            value="{{$code}}"
            @disabled(!$code)
            @selected(empty($old) && empty($value) && empty($code))
            @selected(empty($old) && !empty($value) && $value === $code)
            @selected(!empty($old) && $old === $code)

            @if(!empty($code) && isset($optionData[$code]) && is_array($optionData[$code]))
                @foreach($optionData[$code] as $dc=>$data)
                    data-{{$dc}}="{{$data}}"
                @endforeach
            @endif
        >
            {{$item}}
        </option>
    @endforeach
</select>
