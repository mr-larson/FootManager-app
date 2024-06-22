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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center bg-bottom md:bg-left md:pt-0 bg-slate-100 bg-contain bg-no-repeat" style="background-image: url('{{ asset('build/assets/images/image8.png') }}');">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div             class="w-4/5 sm:max-w-md mt-3 mx-2 px-6 py-4 bg-white shadow-lg overflow-hidden rounded-lg border border-gray-300 opacity-90"

            {{ $slot }}
            </div>
        </div>

    </body>
</html>
