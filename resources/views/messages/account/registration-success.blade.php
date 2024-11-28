<x-html.h3 text="Регистрация" />
<p class="text-green-700 mb-4 font-bold">
    Вы успешно зарегистрировались.
</p>
<p class="mb-4">
    Для подтверждения указанного Вами Email ({{@$email}}) отправлено письмо со ссылкой.
</p>
<p class="text-red-700 mb-4 font-bold">
    Ссылка действительна до {{$date}}.
</p>
<p class="text-red-700 mb-4 font-bold">
    По истечению времени, при не подтверждении Вашей почты - аккаунт будет удален.
</p>
@if($pass !== null)
    <p class="mb-4 font-bold">
        Так же в письме указан сгенерированный пароль
    </p>
@endif
<p class="mb-4">
    Если у Вас возникли вопросы или проблемы, пожалуйста, свяжитесь с нами:
    <x-html.a link="mailto:helpdo.ed@mgu-mlt.ru" text="helpdo.ed@mgu-mlt.ru"/>
</p>
