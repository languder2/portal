<section class="
        bg-white p-4 rounded-md
        lg:max-w-content lg:mx-auto
">
    <form
        action          = "{{url(route("registration-processing"))}}"
        method          = "POST"
        class           = "max-w-screen-sm mx-auto"
        id              = "changePass"
        name            = "changePass"
        autocomplete    = "off"
    >
        @csrf
        <h3 class="border-b mb-4 pb-1 text-xl">
            Регистрация
        </h3>

        <x-form.errors :list="$errors->all()"/>

        <x-form.input-bb-box
            id="email"
            type="email"
            name="email"
            label="E-mail"
            pattern="^[a-zA-Z0-9_.+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,6}$"
            value="{{old('email')??''}}"
            autocomplete="off"
            required
        />

        <x-form.input-bb-box
            id="lastname"
            type="text"
            name="lastname"
            label="Фамилия"
            value="{{old('lastname')??''}}"
            autocomplete="off"
            required
        />

        <x-form.input-bb-box
            id="firstname"
            type="text"
            name="firstname"
            label="Имя"
            value="{{old('firstname')??''}}"
            autocomplete="off"
            required
        />

        <x-form.input-bb-box
            id="middlename"
            type="text"
            name="middlename"
            label="Отчество"
            value="{{old('middlename')??''}}"
        />

        <x-form.input-bb-box
            id="Password"
            type="password"
            name="password"
            label="Новый пароль"
            value=""
            autocomplete="off"
            minlength="8"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*_+\-=\(\)]).{8,}$"
            required
            disabled="{{old('passGenerate')}}"
        />



        <x-form.input-bb-box
            id="PassConfirm"
            type="password"
            name="confirm"
            label="Подтверждение пароля"
            value=""
            autocomplete="off"
            minlength="8"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*_+\-=\(\)]).{8,}$"
            required
            disabled="{{old('passGenerate')}}"
        />

        <div class="flex justify-between">
            <x-form.checkbox
                id="passwordGenerate"
                name="passGenerate"
                value="on"
                text="Сгенерировать пароль"
                dataOptions="
                    data-link-generate={{url(route('password-generate'))}}
                    data-link-set={{url(route('change-password-processing'))}}
                "
            />
            <div class="text-right">
                <x-form.button
                    value="Зарегистрироваться"
                />
            </div>
        </div>

        <p class="font-bold my-2">
            Требования к паролю:
        </p>
        <ul class="list-disc ml-4">
            <li>
                Содержать не менее 8 символов.
            </li>
            <li>
                Содержать как минимум одну строчную букву (a-z).
            </li>
            <li>
                Содержать как минимум одну прописную букву (A-Z).
            </li>
            <li>
                Содержать хотя бы одну цифру (0-9).
            </li>
            <li>
                Содержать хотя бы один специальный символ:
                <span class="text-wrap inline-block">
                    ! @ # $ % ^ & * ( ) _ + - =
                </span>
            </li>
        </ul>

    </form>
</section>
