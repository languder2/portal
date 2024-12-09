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

        <x-form.input-bb-box type="hidden" name="id" value="{{@$student->id}}"/>

        <x-html.h3 text='Учебные данные студента ФГБОУ ВО "МелГУ"'/>

        <x-form.errors :list="$errors->all()"/>

        @if(is_null(@$uDetail->snils))
            <x-form.input-bb-box
                id="snils"
                type="text"
                name="snils"
                label="СНИЛС (000-000-000 00)"
                value="{{old('snils')??@$detail->snils}}"
                autocomplete="off"
                pattern="[0-9]{3}-[0-9]{3}-[0-9]{3} [0-9]{2}"
                :popover="[
                'title' => 'Поле ввода СНИЛСа',
                'text'  => 'формат: <b>000-000-000 00</b>',
            ]"
                required
            />
        @endif

        <x-form.select
            id="faculty"
            name="faculty"
            null="Выберите факультет"
            :list="$faculties->options??[]"
            :optionData="$faculties->options??[]"
            :old="old('faculty')"
            :value="@$student->faculty"
        />

        <x-form.select
            id="department"
            name="department"
            null="Выберите кафедру"
            :list="$departments->options??[]"
            :optionData="$departments->data??[]"
            :old="old('department')"
            :value="@$student->department"
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
            :value="@$student->level"
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
            :value="@$student->form"
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
            :value="@$student->speciality"
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
            :value="@$student->course"
            required
        />

        <x-form.input-bb-box
            type="text"
            name="group_number"
            id="group_number"
            label="Номер группы"
            value="{{old('group_number')??@$student->group_number}}"
            required
        />

        <x-form.input-bb-box
            type="text"
            name="contract_number"
            id="contract_number"
            label="Номер договора"
            value="{{old('contract_number')??@$student->contract_number}}"
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
            value="{{old('year_from')??@$student->year_from}}"
        />

        <x-form.input-bb-box
            type="year"
            name="year_to"
            id="year_to"
            pattern="^[2]\d{3}$"
            label="Год окончания обучения"
            value="{{old('year_to')??@$student->year_to}}"
        />

        <div class="text-right">
            <x-form.button
                value="Сохранить"
            />
        </div>
    </form>

</section>
@dump(@$student)
