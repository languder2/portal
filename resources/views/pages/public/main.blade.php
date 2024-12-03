@extends('layouts.public.app')

@section('title', 'Портал ФГБОУ ВО "МелГУ"')

@section('content')

    @include("account.public.forms.login")

    @include("content.public.main")

@endsection

@section('menu')
    @include("layouts.public.menu")
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
