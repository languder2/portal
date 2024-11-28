<x-html.h3 text="Токен недействителен" />
<p class="mb-4 font-bold text-red-700">
    Код неверен или время его действия истекло.
</p>
<p class="mb-4">
    В письме указано время до которого токен действителен.
</p>
<p class="mb-4">
    После его истечение аккаунт удаляется и Вы можете пройти
    <x-html.a link="{{url(route('registration'))}}" text="регистрацию" class="font-bold"/>
    повторно.
</p>

<p class="mb-4 pt-4 border-t">
    Если у Вас возникли вопросы или проблемы, пожалуйста, свяжитесь с нами:
    <x-html.a link="mailto:helpdo.ed@mgu-mlt.ru" text="helpdo.ed@mgu-mlt.ru"/>
</p>
