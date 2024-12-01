<section class="bg-white p-4 rounded-md mb-4 lg:max-w-[700px] lg:mx-auto">
    <x-html.h3 text="Персональные данные"/>

    <div class="grid lg:grid-cols-5 gap-0 lg:gap-4">
        <div class="lg:col-span-2 font-bold">
            ФИО:
        </div>
        <div class="lg:col-span-3">
            {{$user->firstname}}
            {{$user->middlename}}
            {{$user->lastname}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Email:
        </div>
        <div class="lg:col-span-3">
            {{$user->email}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Телефон:
        </div>
        <div class="lg:col-span-3">
            {{$detail->phone??__("")}}
        </div>

        <div class="lg:col-span-2 font-bold">
            Пол:
        </div>
        <div class="lg:col-span-3">
            {{@$detail->sex}}
        </div>

    </div>

    <hr class="my-2">
    <div class="text-right">
        <x-html.a link="{{url(route('home'))}}" text="Редактировать" class="lowercase"/>
    </div>
</section>
