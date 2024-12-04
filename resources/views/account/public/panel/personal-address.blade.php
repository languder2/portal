<section class="
        bg-white p-4 rounded-md mb-4
{{--        lg:max-w-content lg:mx-auto--}}
">
    <x-html.h3 text="Прописка и адрес проживания"/>

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            Прописка
        </div>
        <div class="lg:col-span-3">
            @if(isset($detail->address) and $detail->address !== null)
                {{implode(", ",(array)json_decode($detail->address))}}
            @endif
        </div>

        <div class="lg:col-span-2 font-bold">
            Адрес проживания
        </div>
        <div class="lg:col-span-3">
            @if(isset($detail->address) and $detail->address !== null)
                {{implode(", ",(array)json_decode($detail->residence_address))}}
            @endif
        </div>
    </div>

    <hr class="my-2">
    <div class="text-right">
        <x-html.a link="{{url(route('home'))}}" text="Редактировать" class="lowercase"/>
    </div>



</section>
