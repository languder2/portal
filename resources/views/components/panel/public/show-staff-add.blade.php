<section class="
        bg-white p-4 rounded-md mb-4
">
    <div class="flex flex-col lg:flex-row items-center">
        <div class="flex-1">
            @if(count($list))
                Вы можете указать несколько записей о трудоустройстве
            @else
                Данные о трудоустройстве еще не заполнены
            @endif
        </div>
        <hr class="my-4 w-full lg:hidden">
        <div class="flex-1 text-center lg:flex-none lg:text-right">
            <x-html.a-btn
                :link="url(route('add:staff'))"
                text="добавить"
                class="font-semibold"
            />
        </div>
    </div>
</section>
