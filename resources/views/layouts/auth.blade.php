<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ Vite::asset('resources/images/app/logo.png') }}" type="image/png">
    <title>@yield('page-title', '') {{ config('app.name', '') }}</title>
    {{-- basic css and js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-950 ">

    {{-- content of app --}}
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    {{-- footer --}}
    @include('partials.footer')
</body>
</html>