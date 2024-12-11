<li>
    <a  href    = "{{$link??'#'}}"
        class   = "
           block
           text-gray-300
           duration-300
           active:text-gray-400
           -mr-4 pl-10 pr-4 py-1
           hover:bg-white
           hover:text-red-700
           hover:rounded-l-full
           rounded-none
           relative
           group

           @if(isset($class))
               {{$class}}
           @endif;

           after:bg-bgImgItemMenuAfter
           after:absolute
           after:z-0
           after:block
           after:h-4
           after:w-4
           after:-bottom-4
           after:right-0
           after:bg-cover
           after:opacity-0
           after:hover:opacity-100
           after:duration-300
           after:hover:z-10

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
    @if(isset($icons))
        <div
            class="
                block w-4 h-4
                absolute
                left-4
                top-[11px]
                bg-account
                bg-contain
                bg-center
                bg-no-repeat
                group-hover:stroke-baseRed
                stroke-white
                hover:stroke-baseRed
            "
        >
            <x-html.svg name="{!! $icons !!}"/>
        </div>
    @endif

        {{@$text}}
    </a>
</li>
