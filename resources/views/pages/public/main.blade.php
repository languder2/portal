@extends('layouts.app')

@section('title', 'Портал ФГБОУ ВО "МелГУ"')

@section('content')
    @if(!isset($atuhCheck))
        @include("user.public.forms.login")
    @endif

    @include("content.public.main")

@endsection
