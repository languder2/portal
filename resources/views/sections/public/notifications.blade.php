@if(isset($list) && count($list))
    <section class="
            rounded-md mb-4 bg-white p-4 rounded-b-md
{{--            lg:max-w-content lg:mx-auto--}}
">
        <x-html.h3 text="Уведомления" class="" />
        @foreach($list as $item)
            <x-callout :item="$item"/>
        @endforeach
    </section>
@endif
