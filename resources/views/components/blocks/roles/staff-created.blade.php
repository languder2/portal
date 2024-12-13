<div class="ml-4 pl-4">
    <h4 class="font-semibold -ml-4">
        {{$role->name}}:
    </h4>
    <p>
        Заявка была поддана
        <span class="text-nowrap font-semibold">
            {{$role->created_at->format('d-m-Y H:i')}}
        </span>
    </p>
    @if($role->created_at->format('d-m-Y H:i') !== $role->updated_at->format('d-m-Y H:i'))
        <p>
            Последний раз была обновлена в {{$role->updated_at->format('d-m-Y H:i')}}
        </p>
    @endif
    <p>
        Вы можете проверить поданные данные на странице
        <x-html.a
            link="{{url(route('show:staff'))}}"
            text="Рабочие данные"
            class="font-semibold text-nowrap"
        />
    </p>
</div>
