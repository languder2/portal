<section class="bg-white p-4 rounded-l-md">
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
            type="password"
            name="newPass"
            id="newPassword"
            label="Новый пароль"
            minlength="8"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$"
            required
        />

        <x-form.input-bb-box
            type="password"
            name="newPassConfirm"
            id="newPassConfirm"
            label="Подтверждение пароля"
            minlength="8"
            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$"
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

        <p class="font-bold mt-2">
            Требования к паролю:
        </p>
        <ul class="list-disc ml-8">
            <li>
                должен быть на латинице (английские буквы)
            </li>
            <li>
                наличие хотя бы одной буквы в верхнем регистре
            </li>
            <li>
                наличие хотя бы одной буквы в нижнем регистре
            </li>
            <li>
                наличие как минимум одной цифры
            </li>
            <li>
                наличие специального символа из набора
                <b>@$!%*#?&</b>
            </li>
            <li>
                минимальная длина пароля — 8 символов
            </li>
        </ul>
    </form>
</section>
