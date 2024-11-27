<x-html.h3 text="Неверный токен" />
<p class="text-red-700 font-bold mb-2">
    Ссылка неверна или истек ее срок действия.
</p>
<p class="mb-2">
    Вы можете повторно пройти процедуру
    <x-html.a link="{{url(route('pass.recovery'))}}" text="восстановления доступа"/>
</p>
<p class="mb-2">
    Если у вас возникнут вопросы или проблемы, пожалуйста, свяжитесь с нами:
    <x-html.a link="mailto:helpdo.ed@mgu-mlt.ru" text="helpdo.ed@mgu-mlt.ru"/>
</p>
