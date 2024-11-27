<a
    href        = "{{$link}}"
    class       = "text-baseRed hover:text-red-700 active:text-gray-700"
    @if(isset($target))
        target  = "{{$target}}"
    @endif
>
    {{@$text}}
</a>
