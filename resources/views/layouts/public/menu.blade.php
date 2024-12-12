<nav id="sidebar" class="fixed left-0 top-0 bottom-0 md:w-18rem bg-baseRed p-4 hidden md:block">
    <a href="{{url("/")}}" class="flex items-center transition-all duration-3 hover:scale-105">
        <x-logo width="4rem" stroke="#fff"/>
        <span class="block px-4 font text-white text-center uppercase">
                Портал<br> ФГБОУ ВО "МелГУ"
        </span>
    </a>

        @if(auth()->check())
            <ul class="mt-6">
                @if(isset($roles['admin']) && !is_null($roles['admin']->confirmed_at))
                    <x-li-menu
                         icons="account"
                         link="{{url(route('admin'))}}"
                         text="Админ панель"
                    />
                @endif

                <x-li-menu
                     icons="account"
                     link="{{url(route('account'))}}"
                     text="Личный кабинет"
                />

                <x-li-menu
                     icons="personal"
                     link="{{url(route('show:personal'))}}"
                     text="Персональные данные"
                />

                @if(isset($roles['student']))
                    <x-li-menu
                        icons="student"
                        link="{{url(route('show:education'))}}"
                        text="Учебные данные"
                    />
                @endif

                @if(isset($roles['staff']))
                    <x-li-menu
                         icons="staff"
                         link="{{url(route('show:staff'))}}"
                         text="Рабочие данные"
                    />
               @endif

                <x-li-menu
                     icons="military"
                     link="{{url(route('show:personal'))}}"
                     text="Военный учет"
                />

                <x-li-menu
                     icons="pass"
                     link="{{url(route('change-password'))}}"
                     text="Смена пароля"
                />

            </ul>
        @else
            <ul class="mt-6">
                <x-li-menu
                    icons="account"
                    link="{{url(route('home'))}}"
                    text="Авторизация"
                />

                <x-li-menu
                    icons="staff"
                    link="{{url(route('registration'))}}"
                    text="Регистрация"
                />

                <li>
                    <x-html.a-white link="{{url(route('pass.recovery'))}}" text="Восстановление доступа"/>
                </li>
            </ul>
       @endif

    <hr class="my-2 mx-0">

    <ul>
        <x-li-menu
            icons="faq"
            link="{{url(route('under-construction'))}}"
            text="Вопросы и ответы"
        />

        <x-li-menu
            icons="melsu"
            link="https://melsu.ru"
            text="МелГУ"
        />

        <x-li-menu
            icons="news"
            link="{{url(route('under-construction'))}}"
            text="Новости"
        />

        <x-li-menu
            icons="previews"
            link="{{url(route('under-construction'))}}"
            text="Анонсы"
        />

        <x-li-menu
            icons="actions"
            link="{{url(route('under-construction'))}}"
            text="Клубы"
        />
    </ul>
    <div class="copyright text-center text-white bottom-0 fixed left-0 text-xs py-2 w-18rem">
        &copy; 2024 ФГБОУ ВО "МелГУ"
    </div>
</nav>
