<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventera') }} - Point of Sale</title>

    <!-- Material Symbols & Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .mesh-blob-1 { background-color: #d8e2ff; filter: blur(100px); }
        .mesh-blob-2 { background-color: #ffdbcc; filter: blur(120px); }
        .mesh-blob-3 { background-color: #72fe88; filter: blur(140px); opacity: 0.3; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container overflow-hidden relative">

    <!-- Soft Mesh Gradient Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-5%] w-[60vw] h-[60vw] mesh-blob-1 rounded-full opacity-70"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[50vw] h-[50vw] mesh-blob-2 rounded-full opacity-60"></div>
        <div class="absolute top-[30%] left-[30%] w-[40vw] h-[40vw] mesh-blob-3 rounded-full"></div>
    </div>

    <div class="flex h-screen w-full overflow-hidden">
        <!-- Sidebar -->
        @include('components.liquid.sidebar')

        <!-- Main Content: full height, no extra padding -->
        <main class="flex-1 md:pl-[344px] h-screen flex flex-col overflow-hidden p-6">
            {{ $slot }}
        </main>
    </div>

    <!-- Payment Modal Portal: langsung di bawah body, bebas dari semua flex container -->
    @isset($modal)
        {{ $modal }}
    @endisset

</body>
</html>
