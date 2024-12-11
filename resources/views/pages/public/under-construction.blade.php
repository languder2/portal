@extends('layouts.public.app')

@section('title', 'Уведомление')

@section('headTitle', 'Портал ФГБОУ ВО "МелГУ": Уведомление')

@section('content')

    <div class="mb-4">
        <img src="{!! asset('img/under-construction.jpg') !!}" class="rounded-md"/>
    </div>

@endsection

@section('menu')
    @include("layouts.public.menu",[
        'roles'     => \App\Models\Role::getUserRoles()
    ])
@endsection

@section('news')

    @include(
        "layouts.public.news",
        [
            'list'  => \App\Models\User::orderBy('id','desc')->limit(3)->get()
        ]
    )
@endsection
