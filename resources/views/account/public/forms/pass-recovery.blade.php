<section class="bg-white p-4 rounded-l-md">
    <form
        action          = "{{url(route("pass-recovery-create-token"))}}"
        method          = "POST"
        id              = "formLogin"
        name            = "formLogin"
        class           = "max-w-screen-sm mx-auto"
        autocomplete    = "on"
    >
        @csrf
        <h3 class="border-b mb-4 pb-1 text-xl">
            Не помните пароль?
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
        <div class="text-right">
            <x-form.button
                value="Восстановить пароль"
            />
        </div>

        <p class="text-center my-2">
            Нет аккаунта?
            <a  href    = "{{url(route('register'))}}"
                class   = "text-baseRed hover:text-red-700 active:text-gray-700"
            >
                Зарегистрируйтесь
            </a>
        </p>

        <p class="text-center my-2">
            Вспомнили - попробуйте
            <a  href    = "{{url(route('home'))}}"
                class   = "text-baseRed hover:text-red-700 active:text-gray-700"
            >
                войти
            </a>
        </p>
    </form>

</section>
