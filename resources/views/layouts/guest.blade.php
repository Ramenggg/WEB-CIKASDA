<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center mb-8">
                <a href="/">
                    <img src="{{ asset('images/logo/logo-cikasda.png') }}" class="h-16 w-auto mb-4 drop-shadow-md hover:scale-105 transition-transform duration-300" alt="Logo CIKASDA">
                </a>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Panel Admin</h2>
                <p class="text-sm text-gray-500 mt-1">Dinas CIKASDA Provinsi Sulawesi Tengah</p>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
