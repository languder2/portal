<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    <!-- Общий хедер -->
</header>

<main class="flex bg-amber-600 flex-wrap">
    <nav class="sidebar bg-blue-400">
        @yield('menu')
        asd
        asd
    </nav>
    <section class="bg-amber-950 w">
        @yield('content')
    </section>
</main>

<footer>
    <!-- Общий футер -->
</footer>
</body>
</html>
