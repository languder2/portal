<section class="
        bg-white p-4 rounded-md mb-4
        lg:max-w-content lg:mx-auto
">
    <x-html.h3 text="Персональные данные"/>

    @if(!is_null($errors) && $errors->all())
        <div class="border-2 border-l-4 border-l-red-700 mb-6 px-3 py-2 rounded-md">
            @foreach ($errors->all() as $message)
                <div>
                    {!! $message !!}
                </div>
            @endforeach
        </div>
    @endif

    <form
        action          = "{{url(route('save:personal-identification'))}}"
        method          = "POST"
        id              = "changePersonalIdentification"
        name            = "changePersonalIdentification"
        autocomplete    = "on"
    >
        @csrf
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

        <x-form.input-bb-box
            id="inn"
            type="text"
            name="inn"
            label="Идентификационный код"
            value="{{old('inn')??@$detail->inn}}"
            pattern="[0-9]{12}"
            autocomplete="off"
            :popover="[
                'title' => 'Поле ввода ИНН',
                'text'  => 'Номер должен состоять из 12 цифр',
            ]"
        />

        <x-form.input-bb-box
            id="citizenship"
            type="text"
            name="citizenship"
            label="Гражданство"
            value="{{old('citizenship')??@$detail->citizenship}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_type"
            type="text"
            name="document_type"
            label="Тип удостоверяющего документа"
            value="{{old('document_type')??@$detail->document_type}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_serial"
            type="text"
            name="document_serial"
            label="Серия документа"
            value="{{old('document_serial')??@$detail->document_serial}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_number"
            type="text"
            name="document_number"
            label="Номер документа"
            value="{{old('document_number')??@$detail->document_number}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_issue_date"
            type="date"
            name="document_issue_date"
            label="Дата выдачи документа"
            value="{{old('document_issue_date')??@$detail->document_issue_date}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_issue_whom"
            type="text"
            name="document_issue_whom"
            label="Кем выдан документа"
            value="{{old('document_issue_whom')??@$detail->document_issue_whom}}"
            autocomplete="off"
        />

        <x-form.input-bb-box
            id="document_issue_whom_code"
            type="text"
            name="document_issue_whom_code"
            label="Код подразделения выдавшего документа"
            value="{{old('document_issue_whom_code')??@$detail->document_issue_whom_code}}"
            pattern="[0-9]{3}-[0-9]{3}"
            autocomplete="off"
            :popover="[
                'title' => 'Код подразделения',
                'text'  => 'формат: <b>000-000</b>',
            ]"
        />

        <div class="text-right">
            <x-form.button
                value="Сохранить"
            />
        </div>
    </form>
</section>



