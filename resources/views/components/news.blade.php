<div
    class="
        news
        mb-4 last:mb-0
        rounded-md
        relative
        bg-white
        h-[15rem]
        @if(isset($class)){{$class}}@endif
    "
>
    <div class="4xl:w-[20rem] w-full h-[15rem] block rounded-md absolute z-0"

         style="
            background: url({!! $news->preview !!}) no-repeat center;
            background-size: cover;
         "
    >
    </div>

    <div class="
            leading-5
            absolute z-10
{{--            bg-green-800--}}
{{--            md:bg-green-400--}}
{{--            lg:bg-orange-400--}}
{{--            xl:bg-red-300--}}
{{--            2xl:bg-red-400--}}
{{--            3xl:bg-red-500--}}
{{--            4xl:bg-red-700--}}

            px-4 py-2
            bottom-0 right-0

            md:rounded-r-md
            2xl:rounded-b-md
            2xl:rounded-tr-none
            4xl:rounded-b-md
            4xl:rounded-tr-md
            4xl:rounded-bl-none

            top-auto
            xl:top-0
            2xl:top-auto
            4xl:top-0

            left-0
            xl:left-[20rem]
            2xl:left-0
            4xl:left-[20rem]

            overflow-hidden
            "
    >
        <h4 class="font-semibold">
            {!! @$news->date !!}<br>
            {!! $news->title !!}
        </h4>
        <div class="hidden lg:block xl:block 2xl:hidden 3xl:block 4xl:hidden">
            {!! @$news->short !!}
        </div>
        <div class="hidden xl:block 2xl:hidden 4xl:block">
            {!! @$news->full !!}
        </div>

    </div>

{{--    @dump($news)--}}
</div>
