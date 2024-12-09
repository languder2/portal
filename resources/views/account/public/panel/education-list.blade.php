@include('content\public\account\education-add',[
    'count' =>  $list->count()
])


@foreach($list as $record)
    <x-account.education
        :record="$record"
    />
@endforeach
