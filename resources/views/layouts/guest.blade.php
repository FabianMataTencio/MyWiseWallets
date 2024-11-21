<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>WiseWallet</title>

        <!-- Fonts -->
        <link rel="icon" href="{{asset('imgs/logo.png')}}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <section class="flex flex-col items-center py-10">
                <div class="relative w-full max-w-lg md:w-96">
                    <div class="absolute inset-0 bg-cover bg-center rounded-lg"
                        style="background-image: url('{{ asset('imgs/back_ground.jpg') }}'); background-size: cover;">
                    </div>
                    <div class="relative bg-gray-600 bg-opacity-70 p-14 rounded-lg shadow-lg">
                        {{ $slot }}
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>

