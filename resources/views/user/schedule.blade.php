<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css">
    </head>

    <div class="py-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold mb-4">Jadwal Pengangkutan Sampah</h1>
            <div id="calendar"></div>

        </div>
    </div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</x-app-layout>

