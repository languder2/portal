<a  href    = "{{$link??'#'}}"
    class   = "
        bg-baseRed
        px-4
        py-2
        rounded-md
        text-white
        hover:bg-red-700
        active:bg-gray-700
        @if(isset($class))
            {{$class}}
        @endif;

">
    {{@$text}}
</a>
