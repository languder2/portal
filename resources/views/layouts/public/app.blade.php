<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200">
@include("layouts.public.header")

@yield('menu')

<main
    class   = "
        mt-4 mx-4
        md:ml-19rem
        flex flex-col
        2xl:gap-4 2xl:flex-row
">
    <section class="content border-red-600 flex-1 lg:w-auto">
        @yield('content')
    </section>
    <section
        id="sidebar-right"
        class="
            flex-none
            w-full
            2xl:w-[20rem]
            3xl:w-[30rem]
            4xl:w-[40rem]
    ">
        @yield('news')
    </section>
</main>




</body>
</html>
