@extends('layouts.public.app')

@section('title', 'Восстановление пароля"')

@section('headTitle', $headTitle??'Портал ФГБОУ ВО "МелГУ"')

@section('content')

    @if(isset($form))
        {!! @$form !!}
    @endif

    @if(isset($sections) && is_array($sections))
        @foreach($sections as $section)
            {!! $section !!}
        @endforeach
    @endif

    @if(isset($contents) && is_array($contents))
        @foreach($contents as $content)
            {!! $content !!}
        @endforeach
    @endif
@endsection

@section('menu')
    @include("layouts.public.menu")
@endsection

@section('news')

    @include(
        "layouts.public.news",
        [
            'list'  => \App\Models\User::orderBy('id','desc')->limit(3)->get()
        ]
    )
@endsection
