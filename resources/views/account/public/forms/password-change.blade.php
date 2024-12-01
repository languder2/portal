<section class="bg-white p-4 rounded-md">
    <form
        action          = "{{url(route("change-password-processing"))}}"
        method          = "POST"
        class           = "max-w-screen-sm mx-auto"
        id              = "changePass"
        name            = "changePass"
    >
        @csrf
        <h3 class="border-b mb-4 pb-1 text-xl">
            Смена пароля
        </h3>

        <p class="mb-4">
            Укажите новый пароль и подтвердите его.<br>
            Или предоставьте системе сгенерировать его.
        </p>

        @if(!is_null($errors) && $errors->all())
            <div class="border-2 border-l-4 border-l-red-700 mb-6 px-3 py-2 rounded-md">
                @foreach ($errors->all() as $message)
                    <div>
                        {!! $message !!}
                    </div>
                @endforeach
            </div>
        @endif

        <x-form.input-bb-box
            id="Password"
            type="password"
            name="newPass"
            label="Новый пароль"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*_+\-=\(\)]).{8,}$"
            required
        />

        <x-form.input-bb-box
            id="PassConfirm"
            type="password"
            name="newPassConfirm"
            label="Подтверждение пароля"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*_+\-=\(\)]).{8,}$"
            minlength="8"
            required
        />

        <div class="flex justify-between">
            <x-form.checkbox
                id="passwordGenerate"
                name="passGenerate"
                text="Сгенерировать пароль"
                dataOptions="
                    data-link-generate={{url(route('password-generate'))}}
                    data-link-set={{url(route('change-password-processing'))}}
                "
            />
            <div class="text-right">
                <x-form.button
                    value="Сменить"
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
