<section class="
        bg-white p-4 rounded-md mb-4
{{--        lg:max-w-content lg:mx-auto--}}
">
    <x-html.h3 text="Персональные данные"/>

    <x-form.errors :list="$errors->all()"/>

    <form
        action          = "{{url(route('save:personal-base'))}}"
        method          = "POST"
        id              = "changePersonalBase"
        name            = "changePersonalBase"
        autocomplete    = "off"
    >
        @csrf

        <x-form.input-bb-box
            id="lastname"
            type="text"
            name="lastname"
            label="Фамилия"
            value="{{old('lastname')??@$user->lastname}}"
            autocomplete="off"
            required
        />

        <x-form.input-bb-box
            id="firstname"
            type="text"
            name="firstname"
            label="Имя"
            value="{{old('firstname')??@$user->firstname}}"
            autocomplete="off"
            required
        />

        <x-form.input-bb-box
            id="middlename"
            type="text"
            name="middlename"
            label="Отчество"
            value="{{old('middlename')??@$user->middlename}}"
        />

        <x-form.input-bb-box
            type="email"
            name="email"
            id="changeEmail"
            label="Email"
            required
            value="{{old('email')??$user->email}}"
            pattern="^[a-zA-Z0-9_.+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,6}$"
            required
        />

        <x-form.input-bb-box
            type="tel"
            name="phone"
            id="changePhone"
            label="Телефон"
            value="{{old('phone')??@$detail->phone}}"
        />

        <x-form.select
            id="sex"
            name="sex"
            label="Выберите пол"
            nullDisabled
            :list="[
                null            => 'Выберите пол',
                'man'           => 'Мужчина',
                'woman'         => 'Женщина',
            ]"
            :old="old('sex')"
            :value="@$detail->sex"
        />

        <x-form.input-bb-box
            type="date"
            name="birthday"
            id="birthday"
            label="Дата рождения"
            value="{{old('birthday')??@$detail->birthday}}"
        />

        <div class="text-right">
            <x-form.button
                value="Сохранить"
            />
        </div>
    </form>
</section>
