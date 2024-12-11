<section class="
        bg-white p-4 rounded-md mb-4
{{--        lg:max-w-content lg:mx-auto--}}
">
    <x-html.h3 text="Паспортные данные"/>

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            СНИЛС:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->snils}}
        </div>

        <div class="lg:col-span-2 font-bold">
            ИНН:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->inn}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Гражданство:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->citizenship}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Документ:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->document_type}}
            {{@$detail->document_serial}}
            {{@$detail->document_number}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Дата выдачи:
        </div>
        <div class="lg:col-span-3">
            @if(@$detail->document_issue_date)
                {{Carbon\Carbon::createFromDate($detail->document_issue_date)->format('d.m.Y')}}
            @endif
        </div>

        <div class="lg:col-span-2 font-bold">
            Код подразделения:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->document_issue_whom_code}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Кем выдан:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->document_issue_whom}}
        </div>
    </div>

    <hr class="my-2">
    <div class="text-right">
        <x-html.a link="{{url(route('change:personal-identification'))}}" text="Редактировать" class="lowercase"/>
    </div>
</section>
