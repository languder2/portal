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
            value="{{old('date_from')??@$education->contract_number}}"
            :popover="[
                'title' => 'Поле номера договора',
                'text'  => 'Не обязательное поле, для студентов контрактного обучения',
            ]"

        />

        <x-form.input-bb-box
            type="year"
            name="date_from"
            id="date_from"
            label="Год начала обучения"
            value="{{old('date_from')??@$education->date_from}}"
        />

        <x-form.input-bb-box
            type="year"
            name="date_to"
            id="date_to"
            label="Год окончания обучения"
            value="{{old('date_to')??@$education->date_to}}"
        />


    </form>

</section>
