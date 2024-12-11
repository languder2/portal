<section class="
            bg-white p-4 rounded-md mb-4
">
    <form
        action          = "{{url(route("save:staff"))}}"
        method          = "POST"
        id              = "formEducation"
        name            = "formEducation"
        autocomplete    = "off"
        class           = "max-w-content mx-auto"
    >
        @csrf

        <x-form.input-bb-box type="hidden" name="id" value="{{@$staff->id}}"/>

        <x-html.h3 text='Данные о трудоустройстве в ФГБОУ ВО "МелГУ"'/>

        <x-form.errors :list="$errors->all()"/>

        <x-form.select
            id="faculty"
            name="ed_faculty"
            null="Выберите факультет"
            :list="$faculties->options??[]"
            :optionData="$faculties->options??[]"
            :old="old('ed_faculty')"
            :value="@$staff->ed_faculty"
        />

        <x-form.select
            id="department"
            name="ed_department"
            null="Выберите кафедру"
            :list="$departments->options??[]"
            :optionData="$departments->data??[]"
            :dependents='$departments->dependents'
            :old="old('ed_department')"
            :value="@$staff->ed_department"
        />

        <x-form.input-bb-box
            type="text"
            name="department"
            id="work_department"
            label="Отдел"
            value="{{old('department')??@$staff->department}}"
        />

        <x-form.input-bb-box
            type="text"
            name="post"
            id="post"
            label="Должность"
            value="{{old('post')??@$staff->post}}"
            required
        />

        <x-form.input-bb-box
            type="date"
            name="employment"
            id="employment"
            label="Дата приема на работу"
            value="{{old('employment')??@$staff->employment}}"
        />

        <x-form.input-bb-box
            type="date"
            name="dismissal"
            id="dismissal"
            label="Дата увольнения"
            value="{{old('dismissal')??@$staff->dismissal}}"
        />

        <div class="text-right">
            <x-form.button
                value="Сохранить"
            />
        </div>
    </form>
</section>
