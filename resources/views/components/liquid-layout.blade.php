<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventera') }} - Dashboard</title>

    <!-- Preload Local Fonts via Vite -->
    <link rel="preload" href="{{ Vite::asset('resources/fonts/inter/inter-regular.ttf') }}" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ Vite::asset('resources/fonts/inter/inter-semibold.ttf') }}" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ Vite::asset('resources/fonts/material-symbols/material-symbols-outlined.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        /* Soft mesh background elements */
        .mesh-blob-1 { background-color: #d8e2ff; filter: blur(100px); } 
        .mesh-blob-2 { background-color: #ffdbcc; filter: blur(120px); } 
        .mesh-blob-3 { background-color: #72fe88; filter: blur(140px); opacity: 0.3; } 
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container overflow-x-hidden relative" x-data="{ sidebarOpen: false }">

    <!-- Soft Mesh Gradient Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-5%] w-[60vw] h-[60vw] mesh-blob-1 rounded-full opacity-70"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[50vw] h-[50vw] mesh-blob-2 rounded-full opacity-60"></div>
        <div class="absolute top-[30%] left-[30%] w-[40vw] h-[40vw] mesh-blob-3 rounded-full"></div>
    </div>

    <div class="flex min-h-screen w-full">
        <!-- Sidebar -->
        @include('components.liquid.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-[344px]">
            <!-- Page Content -->
            <main class="flex-1 p-4 md:p-12 pt-24 md:pt-12 w-full max-w-container-max mx-auto">
                <!-- Topbar -->
                @include('components.liquid.topbar')

                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
