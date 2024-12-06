<section class="
            bg-white p-4 rounded-md mb-4
">
    <form
        action          = "{{url(route("save:education"))}}"
        method          = "POST"
        id              = "formEducation"
        name            = "formEducation"
        autocomplete    = "off"
        class           = "max-w-content mx-auto"
    >
        @csrf
        <x-html.h3 text='Учебные данные студентов ФГБОУ ВО "МелГУ"'/>

        @if(!is_null($errors) && $errors->all())
            <div class="border-2 border-l-4 border-l-red-700 mb-6 px-3 py-2 rounded-md">
                @foreach ($errors->all() as $message)
                    <div>
                        {!! $message !!}
                    </div>
                @endforeach
            </div>
        @endif

        <x-form.select
            id="faculty"
            name="faculty"
            null="Выберите факультет"
            :list="$faculties->options??[]"
            :optionData="$faculties->options??[]"
            :old="old('faculty')"
            :value="@$education->faculty"
            required
        />

        <x-form.select
            id="department"
            name="department"
            null="Выберите кафедру"
            :list="$departments->options??[]"
            :optionData="$departments->data??[]"
            :old="old('department')"
            :value="@$education->department"
            :dependents='$departments->dependents'
            required
        />

        <x-form.select
            id="level"
            name="level"
            null="Выберите уровень образования"
            :list="$levels->options??[]"
            :optionData="$levels->data??[]"
            :old="old('level')"
            :value="@$education->level"
            :dependents='$levels->dependents'
            required
        />

        <x-form.select
            id="form"
            name="form"
            null="Выберите форму обучения"
            :list="$forms->options??[]"
            :optionData="$forms->data??[]"
            :old="old('form')"
            :value="@$education->form"
            :dependents='$forms->dependents'
            required
        />

        <x-form.select
            id="speciality"
            name="speciality"
            null="Выберите специальность"
            :list="$specialities->options??[]"
            :optionData="$specialities->data??[]"
            :old="old('speciality')"
            :value="@$education->speciality"
            :dependents='$specialities->dependents'
            required
        />

        <x-form.select
            id="course"
            name="course"
            null="Выберите курс"
            :list="[
                1   => 1,
                2   => 2,
                3   => 3,
                4   => 4,
                5   => 5,
            ]"
            :old="old('course')"
            :value="@$education->course"
            required
        />

        <x-form.input-bb-box
            type="text"
            name="group_number"
            id="group_number"
            label="Номер группы"
            value="{{old('group_number')??@$education->group_number}}"
            required
        />

        <x-form.input-bb-box
            type="text"
            name="contract_number"
            id="contract_number"
            label="Номер договора"
            value="{{old('contract_number')??@$education->contract_number}}"
            :popover="[
                'title' => 'Поле номера договора',
                'text'  => 'Не обязательное поле, для студентов контрактного обучения',
            ]"
        />

        <x-form.input-bb-box
            type="year"
            name="year_from"
            id="year_from"
            pattern="^[2]\d{3}$"
            label="Год начала обучения"
            value="{{old('year_from')??@$education->year_from}}"
        />

        <x-form.input-bb-box
            type="year"
            name="year_to"
            id="year_to"
            pattern="^[2]\d{3}$"
            label="Год окончания обучения"
            value="{{old('year_to')??@$education->year_to}}"
        />

        <div class="text-right">
            <x-form.button
                value="Сохранить"
            />
        </div>
    </form>

</section>
