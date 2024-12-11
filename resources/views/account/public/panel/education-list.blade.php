<x-panel.public.show-education-add :list="$list"/>

@foreach($list as $record)
    <x-account.education
        :record="$record"
    />
@endforeach
