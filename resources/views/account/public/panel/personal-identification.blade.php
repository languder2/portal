<section class="bg-white p-4 rounded-md mb-4 lg:max-w-[700px] lg:mx-auto">
    <x-html.h3 text="Паспортные данные"/>

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            СНИЛС:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->snils}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Паспорт:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->document_serial}}
            {{@$detail->document_number}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Гражданство:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->citizenship}}
        </div>

        <div class="lg:col-span-2 font-bold">
            ИНН:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->inn}}
        </div>
    </div>

    <hr class="my-2">
    <div class="text-right">
        <x-html.a link="{{url(route('home'))}}" text="Редактировать" class="lowercase"/>
    </div>



</section>
