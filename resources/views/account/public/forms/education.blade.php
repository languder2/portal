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
        />

        <x-form.select
            id="department"
            name="department"
            null="Выберите кафедру"
            :list="$departments->options??[]"
            :optionData="$departments->data??[]"
            :old="old('department')"
            :value="@$education->department"
            depended='["faculty"]'
        />
    </form>

</section>
