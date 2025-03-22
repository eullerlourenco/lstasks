<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title', '') {{ config('app.name', '') }}</title>
    {{-- basic css and js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-neutral-900">

    {{-- header --}}
    @include('partials/header')

    {{-- content of app --}}
    <main class="min-h-screen p-4 sm:p-8">
        @yield('content')
    </main>

    {{-- footer --}}
    @include('partials/footer')

    @if (session('alertSuccess'))
        <x-general.toast-message type="success" :message="session('alertSuccess')" />
    @elseif (session('alertError'))
        <x-general.toast-message type="error" :message="session('alertError')" />
    @endif
</body>

</html>
