<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased overflow-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background image with blur (fixed) -->
            <div class="fixed inset-0 bg-cover bg-center bg-no-repeat blur-sm scale-105" style="background-image: url('{{ asset('images/bg-uma.jpg') }}');"></div>
            <div class="fixed inset-0 bg-black/30 dark:bg-black/50"></div>

            <!-- Logo -->
            <div class="relative z-10">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white" />
                </a>
            </div>

            <!-- Form card -->
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white/20 dark:bg-white/10 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-lg border border-white/30">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
