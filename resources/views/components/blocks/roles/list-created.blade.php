@if(count($roles))
    <h3 class="font-semibold">
        Роли на подтверждении:
    </h3>
    @foreach($roles as $role)

        @switch($role->code)
            @case('student')
                <x-blocks.roles.student-created :role="$role" />
            @break
            @case('staff')
                <x-blocks.roles.staff-created :role="$role" />
            @break
        @endswitch
    @endforeach

    <hr class="my-3">
@endif
