<a  href    = "{{$link??'#'}}"
    class   = "

        text-gray-300
        hover:pl-3
        duration-300
        active:text-gray-400
        hover:bg-white hover:-mr-4
        hover:text-red-700
        block
        rounded-l-[5px]
        after:absolute
        after:bg-white
        after:h-1
        after:w-5
        after:rounded-full

        @if(isset($class))
            {{$class}}
        @endif;
">
    {{@$text}}
</a>
