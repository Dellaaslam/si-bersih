<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Si-Bersih') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black relative">

    <!-- TOP BAR (BACK + LOGO + TITLE) -->
    <div class="absolute top-6 left-6 flex items-center space-x-4 z-50">

        <!-- Tombol Kembali -->
        <a href="{{ url('/') }}"
           class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                  bg-green-700 hover:bg-green-800 transition">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"/>
            </svg>
        </a>

        <!-- LOGO + TEXT -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('logo.png') }}" class="h-8 w-8 object-contain" alt="Logo">
            <span class="font-bold text-xl tracking-wide text-green-700">
                SI-BERSIH
            </span>
        </div>

    </div>

    <!-- MAIN LAYOUT -->
    <div class="min-h-screen w-full flex flex-col md:flex-row">

        <!-- LEFT SIDE -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center px-6 md:px-12 py-10">
            <img src="/LandingPage.png" 
                 alt="LandingPage Illustration"
                 class="max-w-xs sm:max-w-sm md:max-w-md w-full mt-10 md:mt-20">
        </div>

        <!-- RIGHT SIDE -->
        <div class="w-full md:w-1/2 bg-green-900 flex justify-center items-center px-6 md:px-10 py-10">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>
