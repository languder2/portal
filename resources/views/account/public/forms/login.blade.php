<section class="
        bg-white p-4 rounded-md
        mb-4
        lg:max-w-content lg:mx-auto
">
    <form
        action          = "{{url(route("auth"))}}"
        method          = "POST"
        id              = "formLogin"
        name            = "formLogin"
        class           = "max-w-screen-sm mx-auto"
        autocomplete    = "on"
    >
        @csrf
        <h3 class="border-b mb-4 pb-1 text-xl">
            Авторизация
        </h3>

        @if(!is_null($errors) && $errors->all())
            <div class="border-2 border-l-4 border-l-red-700 mb-6 px-3 py-2 rounded-md">
                @foreach ($errors->all() as $message)
                    {!! $message !!}
                @endforeach
            </div>
        @endif

        <x-form.input-bb-box
            type="email"
            name="form[email]"
            id="loginEmail"
            label="Email"
            required
            value="{{old('form.email')}}"
        />

        <x-form.input-bb-box
            type="password"
            name="form[password]"
            id="loginPassword"
            label="Пароль"
        />


        <div class="flex justify-between">
            <x-form.checkbox
                id="remember"
                name="form[remember]"
                text="Запомнить меня"
            />

            <div class="text-right">
                <x-form.button
                    value="Войти"
                />
            </div>
        </div>

        <p class="text-center my-2">
            Нет аккаунта?

            <x-html.a link="{{url(route('registration'))}}" text="Зарегистрируйтесь"/>
        </p>
        <p class="text-center my-2">
            <x-html.a link="{{url(route('pass.recovery'))}}" text="Не помните пароль?"/>
        </p>
    </form>
</section>
