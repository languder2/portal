@if(isset($list))
    <section class="rounded-md mb-4 bg-white p-4 last:rounded-b-md">
        <x-html.h3 text="Уведомления" class="" />
        @foreach($list as $item)
            <x-callout :item="$item"/>
        @endforeach
    </section>
@endif
