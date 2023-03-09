<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('nav')
    <main>
        <div class="relative overflow-x-auto pt-5 container mx-auto">
            @yield('content')
        </div>
    </main>
</body>
</html>
