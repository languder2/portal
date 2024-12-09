<section
    class="
        bg-white p-4 rounded-md
        mb-4
        lg:max-w-content lg:mx-auto
    "
>
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

        <x-form.errors :list="$errors->all()"/>

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
            <x-html.a link="{{url(route('registration'))}}" text="Зарегистрируйтесь"/>
        </p>

        <p class="text-center my-2">
            Вспомнили - попробуйте
            <x-html.a link="{{url(route('home'))}}" text="войти"/>
        </p>
    </form>
</section>
