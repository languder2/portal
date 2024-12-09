<section class="
        bg-white p-4 rounded-md mb-4
    ">

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            Факультет:
        </div>
        <div class="lg:col-span-3">
            {{@$record->faculty}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Кафедра:
        </div>
        <div class="lg:col-span-3">
            {{@$record->department}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Уровень:
        </div>
        <div class="lg:col-span-3">
            {{@$record->level}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Форма обучения:
        </div>
        <div class="lg:col-span-3">
            {{@$record->form}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Специальность:
        </div>
        <div class="lg:col-span-3">
            {{@$record->code}}
            {{@$record->speciality}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Группа:
        </div>
        <div class="lg:col-span-3">
            {{@$record->group_number}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Номер контракта:
        </div>
        <div class="lg:col-span-3">
            {{@$record->contract_number}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Годы обучения:
        </div>
        <div class="lg:col-span-3">
            @if(@$record->year_from)
                c {{$record->year_from}}
            @endif

            @if(@$record->year_to)
                до {{$record->year_to}}
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
