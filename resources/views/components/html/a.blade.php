<a  href    = "{{$link??'#'}}"
    class   = "
        text-baseRed
        hover:text-red-700
        active:text-gray-700
        @if(isset($class))
            {{$class}}
        @endif;
">
    {{@$text}}
</a>
