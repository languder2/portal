<section class="
        bg-white p-4 rounded-md mb-4
    ">

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            Факультет:
        </div>
        <div class="lg:col-span-3">
            {{@$record->ed_faculty}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Кафедра:
        </div>
        <div class="lg:col-span-3">
            {{@$record->ed_department}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Департамент:
        </div>
        <div class="lg:col-span-3">
            {{@$record->department}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Должность:
        </div>
        <div class="lg:col-span-3">
            {{@$record->post}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Дата приема на работу:
        </div>
        <div class="lg:col-span-3">
            @if(@$record->employment)
                {{Carbon\Carbon::createFromDate($record->employment)->format('d.m.Y')}}
            @endif
        </div>

        <div class="lg:col-span-2 font-bold">
            Дата увольнения:
        </div>
        <div class="lg:col-span-3">
            @if(@$record->dismissal)
                {{Carbon\Carbon::createFromDate($record->dismissal)->format('d.m.Y')}}
            @endif
        </div>
    </div>

    <hr class="my-2">

    <div class="flex flex-col-reverse xs:flex-row">
        <div class="flex-1 text-right xs:text-left">
            <x-html.a link="{{url(route('delete:education',['id'=>$record->id]))}}" text="удалить" class="lowercase"/>
        </div>
        <div class="flex-1 text-right">
            <x-html.a link="{{url(route('edit:education',['id'=>$record->id]))}}" text="редактировать" class="lowercase"/>
        </div>
    </div>
</section>
