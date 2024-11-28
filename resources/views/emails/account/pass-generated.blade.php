<div style="background: #f0f0f0; padding: 20px;">
    <div style="background: white; max-width: 800px; margin: auto; padding: 20px; border-radius: 15px">
        <h3 style="margin-top: 0">
            Здравствуйте, {{$data->user->firstname}} {{$data->user->middlename}}.
        </h3>
        <hr>
        <section style="font-size: 16px">
            <p>
                Нам поступил запрос на генерацию пароля к Вашему аккаунту.
            </p>
            <p>
                Вам установлен пароль: <b>{{$data->pass}}</b>
            </p>
            <p>
                Теперь Вы можете войти в свой аккаунт на нашем
                <a href="{{url(route("home"))}}">портале</a>
            </p>
            <p>
                Если у вас возникнут вопросы или проблемы, пожалуйста, свяжитесь с нами:
                <a href="mailto:helpdo.ed@mgu-mlt.ru">
                    helpdo.ed@mgu-mlt.ru
                </a>
            </p>
            <hr>
            <p style="text-align: center">
                Письмо сгенерировано автоматически и не требует ответа.
            </p>
            <p style="text-align: center">
                &copy; {{date("Y")}} ФГБОУ ВО "МелГУ"
            </p>
        </section>
    </div>
</div>
