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
    <div
        class="
            w-full
            xl:w-[20rem]
            2xl:w-full
            4xl:w-[20rem]

            h-[15rem] block rounded-md absolute z-0
        "

        style="
            background: url({!! $news->preview !!}) no-repeat center;
            background-size: cover;
        "
    >
    </div>

    <div class="
            leading-5
            absolute z-10
            bg-white
{{--            sm:bg-green-700--}}
{{--            md:bg-green-400--}}
{{--            lg:bg-yellow-400--}}
{{--            xl:bg-orange-400--}}

            px-4 py-2
            bottom-0 right-0

            rounded-b-md
            xl:rounded-bl-none
            xl:rounded-tr-md
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
