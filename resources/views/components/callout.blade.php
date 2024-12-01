<div class="border-[1px] border-l-4 px-3 py-2 rounded-md mb-2 last:mb-0
    @switch($item->type)
        @case("danger")
            border-l-red-500
        @break
        @case("warning")
            border-l-yellow-400
        @break
        @case("success")
            border-l-green-400
        @break
        @case("info")
            border-l-blue-400
        @break
        @default
            border-l-gray-300
        @break
   @endswitch
">
        {!! $item->message !!}
</div>
