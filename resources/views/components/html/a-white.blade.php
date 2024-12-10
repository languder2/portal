<a  href    = "{{$link??'#'}}"
    class   = "

        text-gray-300
        duration-300
        active:text-gray-400
        -mr-4 px-4 py-1
        hover:bg-white
        hover:text-red-700
        block
        rounded-l-[7px]
        relative
        group
        @if(isset($class))
            {{$class}}
        @endif;

        after:bg-bgImgItemMenuAfter
        after:absolute
        after:z-10
        after:block
        after:h-4
        after:w-4
        after:-bottom-4
        after:right-0
        after:bg-cover
        after:opacity-0
        after:hover:opacity-100
        after:duration-300

        before:bg-bgImgItemMenuAfter
        before:absolute
        before:z-10
        before:block
        before:h-4
        before:w-4
        before:-top-4
        before:right-0
        before:bg-cover
        before:opacity-0
        before:hover:opacity-100
        before:duration-300
        before:-scale-y-100

">
    {{@$text}}
</a>

