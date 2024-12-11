<x-panel.public.show-staff-add :list="$list"/>

@foreach($list as $record)
    <x-account.staff
        :record="$record"
    />
@endforeach
