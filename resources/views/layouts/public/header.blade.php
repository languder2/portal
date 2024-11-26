<div class="px-8 py-4 bg-gray-50 md:ml-18rem">
    <div class="flex gap-2">

        <div class="uppercase">
            @yield("headTitle")
        </div>

        <div class="ms-auto"></div>

        <div>
            &nbsp;
        </div>

        <div>
            &nbsp;
            @if(Route::currentRouteName() !== "home")
                @if(auth()->check() === false)
                    <x-html.a-btn link="{{url(route('home'))}}" text="Войти" />
                @else
                    <x-html.a-btn link="{{url(route('logout'))}}" text="Выйти" />
                @endif
            @endif
        </div>
    </div>
</div>
