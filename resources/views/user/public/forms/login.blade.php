<section class="mt-4 ml-0 md:ml-19rem px-4 py-4 bg-white rounded-l-md">
    @dump($errors)

    <form
        action          = "{{url("user/login")}}"
        method          = "POST"
        id              = "formLogin"
        name            = "formLogin"
        class           = "max-w-screen-sm mx-auto"
        autocomplete    = "on"
    >
        @csrf
        <h3 class="border-b mb-4 pb-1">
                Авторизация
        </h3>
        <x-form.input-bb-box
            type="email"
            name="form[email]"
            id="loginEmail"
            label="Email"
            required
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
            <a  href    = "{{url("user/register")}}"
                class   = "text-baseRed hover:text-red-700 active:text-gray-700"
            >
                Зарегистрируйтесь
            </a>
        </p>
        <p class="text-center my-2">
            <a  href    = "{{url("user/pass-recover")}}"
                class   = "text-baseRed hover:text-red-700 active:text-gray-700"
            >
                Не помните пароль?
            </a>
        </p>
    </form>
</section>
