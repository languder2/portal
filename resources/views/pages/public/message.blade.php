@extends('layouts.public.app')

@section('title', 'Уведомление')

@section('headTitle', 'Портал ФГБОУ ВО "МелГУ": Уведомление')

@section('content')
    <section class="bg-white p-4 rounded-l-md">
        {!! @$message !!}
    </section>
@endsection

@section('menu')
    @include("layouts.public.menu")
@endsection


{{--

--}}
