<nav id="sidebar" class="fixed left-0 top-0 bottom-0 md:w-18rem bg-baseRed p-4 hidden md:block">
    <a href="{{url("/")}}" class="flex items-center transition-all duration-3 hover:scale-105">
        <x-logo width="4rem" stroke="#fff"/>
        <span class="block px-4 font text-white text-center uppercase">
                Портал<br> ФГБОУ ВО "МелГУ"
        </span>
    </a>

        @if(auth()->check())
            <ul class="ml-4 mt-6">
                <li class="hover:bg-white hover:-mr-4 duration-500 hover:ps-4">
                    <x-html.a-white link="{{url(route('account'))}}" text="Личный кабинет"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('show:personal'))}}" text="Персональные данные"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('show:education'))}}" text="Учебные данные"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('show:personal'))}}" text="Рабочие данные"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('show:personal'))}}" text="Военный учет"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('change-password'))}}" text="Смена пароля"/>
                </li>

            </ul>
        @else
            <ul class="ml-4 mt-6">
                <li>
                    <x-html.a-white link="{{url(route('home'))}}" text="Авторизация"/>

                </li>
                <li class="hover:bg-white">
                    <x-html.a-white link="{{url(route('registration'))}}" text="Регистрация"/>
                </li>
                <li>
                    <x-html.a-white link="{{url(route('pass.recovery'))}}" text="Восстановление доступа"/>
                </li>
            </ul>
       @endif

    <hr class="my-2 mx-0">

    <ul class="ml-4">
        <li>
            Вопросы и ответы
        </li>
        <li>
            МелГУ
        </li>
        <li>
            Клубы
        </li>
        <li>
            Новости
        </li>
        <li>
            Анонсы
        </li>
        <li>
            Анонсы
        </li>
    </ul>
    <div class="copyright text-center text-white bottom-0 fixed left-0 text-xs py-2 w-18rem">
        &copy; 2024 ФГБОУ ВО "МелГУ"
    </div>
</nav>
