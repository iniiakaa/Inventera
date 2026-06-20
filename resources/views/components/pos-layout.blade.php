<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'Inventera') }} - Point of Sale</title>
 <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">

 <!-- Preload Local Fonts via Vite -->
 <link rel="preload" href="{{ Vite::asset('resources/fonts/inter/inter-regular.ttf') }}" as="font" type="font/ttf" crossorigin>
 <link rel="preload" href="{{ Vite::asset('resources/fonts/inter/inter-semibold.ttf') }}" as="font" type="font/ttf" crossorigin>
 <link rel="preload" href="{{ Vite::asset('resources/fonts/material-symbols/material-symbols-outlined.woff2') }}" as="font" type="font/woff2" crossorigin>

 <!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
  /* Page Transition */
  body > *:not(#global-loader) {
  opacity: 0;
  transition: opacity 0.8s ease-out;
  }
  body.page-loaded > *:not(#global-loader) {
  opacity: 1;
  }
  body.page-leaving > *:not(#global-loader) {
  opacity: 0;
  }

  /* Slide-up Content */
  .slide-up-content {
  transform: translateY(30px) scale(0.95);
  transition: opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }
  body.page-loaded .slide-up-content {
  transform: none;
  }
  body.page-leaving .slide-up-content {
  transform: translateY(-20px) scale(0.98);
  }
  
  /* Global Loader */
  #global-loader {
  position: fixed;
  inset: 0;
  z-index: 99999;
  background-color: #fcf8fb;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  opacity: 1;
  visibility: visible;
  transition: opacity 0.4s ease-out, visibility 0.4s ease-out;
  }
  body.page-loaded #global-loader {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  }
  body.page-leaving #global-loader {
  opacity: 1;
  visibility: visible;
  transition: opacity 0.3s ease-in;
  }

  /* Mesh Background */
  .mesh-blob-1 { background-color: #d8e2ff; filter: blur(100px); }
  .mesh-blob-2 { background-color: #ffdbcc; filter: blur(120px); }
  .mesh-blob-3 { background-color: #72fe88; filter: blur(140px); opacity: 0.3; }
  </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container overflow-hidden relative">

  <!-- Global Loader Overlay -->
  <div id="global-loader">
  <div class="flex flex-col items-center justify-center space-y-10">
  <img src="{{ asset('images/Logo.png') }}" alt="Inventera Logo" class="h-28 w-auto object-contain animate-pulse">
  <div class="w-12 h-12 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
  </div>
  </div>

 <!-- Soft Mesh Gradient Background -->
 <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
 <div class="absolute top-[-10%] left-[-5%] w-[60vw] h-[60vw] mesh-blob-1 rounded-full opacity-70"></div>
 <div class="absolute bottom-[-10%] right-[-5%] w-[50vw] h-[50vw] mesh-blob-2 rounded-full opacity-60"></div>
 <div class="absolute top-[30%] left-[30%] w-[40vw] h-[40vw] mesh-blob-3 rounded-full"></div>
 </div>

 <div class="flex h-screen w-full overflow-hidden">
 <!-- Sidebar -->
 <x-sidebar />

 <!-- Main Content: full height, no extra padding -->
 <main class="slide-up-content flex-1 md:pl-[344px] h-screen flex flex-col overflow-hidden p-6">
 {{ $slot }}
 </main>
 </div>

 <!-- Payment Modal Portal: langsung di bawah body, bebas dari semua flex container -->
 @isset($modal)
 {{ $modal }}
 @endisset

  <!-- Page Transition Logic -->
  <script>
  let isPageLoaded = false;
  window.addEventListener("load", function () {
  isPageLoaded = true;
  setTimeout(() => { 
  document.body.classList.add("page-loaded");
  document.body.classList.remove("page-leaving");
  }, 150);
  });
  
  window.addEventListener("pageshow", function (e) {
  if (e.persisted || isPageLoaded) {
  document.body.classList.add("page-loaded");
  document.body.classList.remove("page-leaving");
  }
  });
  
  window.addEventListener("beforeunload", function () {
  document.body.classList.remove("page-loaded");
  document.body.classList.add("page-leaving");
  });
  
  document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', e => {
  if (
  link.hostname === window.location.hostname &&
  !link.target &&
  !link.hasAttribute('download') &&
  !link.hasAttribute('onclick') &&
  link.href &&
  !link.href.includes('#') &&
  !link.hasAttribute('x-data')
  ) {
  e.preventDefault();
  document.body.classList.remove("page-loaded");
  document.body.classList.add("page-leaving");
  setTimeout(() => {
  window.location = link.href;
  }, 500);
  }
  });
  });
  });
  </script>

</body>
</html>
