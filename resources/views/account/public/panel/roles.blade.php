<section class="
        bg-white p-4 rounded-md mb-4
">
    <x-html.h3 text="Роли"/>
        <x-blocks.roles.list-confirmed :roles="$rolesNames->confirmed??[]" />

        <x-blocks.roles.list-created :roles="$roles->created??[]" />

    <h3 class="font-semibold">
        Студентам ФГБОУ ВО "МелГУ"
    </h3>
    <p>
        Для получения роли студента ФГБОУ ВО "МелГУ" заполните
        <x-html.a
            :link="url(route('add:education'))"
            text="учебные данные."
            class="font-semibold"
        />
    </p>
    <hr class="my-3">
    <h3 class="font-semibold">
        Сотрудникам ФГБОУ ВО "МелГУ"
    </h3>
    <p>
        Для получения роли сотрудника ФГБОУ ВО "МелГУ"
        <x-html.a
            :link="url(route('add:staff'))"
            text="заполните и отправьте форму."
            class="font-semibold"
        />
    </p>
    <p>
        Роли преподавателя и студента не являются взаимоисключающимися.
    </p>
    <hr class="my-3">
    <p>
        Если у Вас возникли вопросы или проблемы ознакомьтесь с разделом

        <x-html.a link="#" text='"Вопросы и ответы"' class="font-semibold"  />
        или свяжитесь с нами

        <x-html.a link="mailto:helpdo.ed@mgu-mlt.ru" text='helpdo.ed@mgu-mlt.ru' class="font-semibold"  />
    </p>
    @dump(@$roles)
</section>
