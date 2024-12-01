<a  href    = "{{$link??'#'}}"
    class   = "
        text-gray-300
        hover:text-white
        hover:pl-3
        duration-300
        active:text-gray-400
        @if(isset($class))
            {{$class}}
        @endif;
">
    {{@$text}}
</a>
