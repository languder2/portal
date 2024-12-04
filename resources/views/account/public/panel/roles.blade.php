<section class="
        bg-white p-4 rounded-md mb-4
{{--        lg:max-w-content lg:mx-auto--}}
">
    <x-html.h3 text="Роли"/>

    @if($roles->count() === 0)
        @include('content.public.account.roles-info')
    @else
        @dump($roles)
    @endif

</section>

