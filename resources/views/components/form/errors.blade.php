@if(count($list))
    <div class="border-2 border-l-4 border-l-red-700 mb-6 px-3 py-2 rounded-md">
        @foreach ($list as $message)
            <div>
                {!! $message !!}
            </div>
        @endforeach
    </div>
@endif
