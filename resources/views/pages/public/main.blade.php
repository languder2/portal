@extends('layouts.public.app')

@section('title', 'Портал ФГБОУ ВО "МелГУ"')

@section('content')

    @include("account.public.forms.login")

@endsection

@section('menu')
    @include("layouts.public.menu",[
        'roles'     => @$roles
    ])
@endsection

@section('news')
    @include(
        "layouts.public.news",
        [
            'list'  => [
                    1,
                    2,
                    3
            ]
        ]
    )
@endsection
