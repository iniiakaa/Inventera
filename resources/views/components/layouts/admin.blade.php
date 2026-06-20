<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{{ $title ?? 'Dashboard' }} - {{ config('app.name', 'Inventera') }}</title>
 <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
 <!-- Preloads -->
 <link rel="preload" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" as="style" />
 <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" as="style" />
 <!-- Material Symbols -->
 <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
 <!-- Google Fonts: Inter -->
 <link href="https://fonts.googleapis.com" rel="preconnect"/>
 <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
 <!-- Flatpickr CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 <!-- ApexCharts -->
 <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
 
 /* Prevent Layout Shifts for Icons */
 .material-symbols-outlined {
 display: inline-block;
 width: 1em;
 height: 1em;
 overflow: hidden;
 white-space: nowrap;
 line-height: 1;
 }
 
 /* Glassmorphism Calendar */
 .flatpickr-calendar {
 background: rgba(255,255,255,0.6) !important;
 backdrop-filter: blur(32px) saturate(2) brightness(1.1) !important;
 -webkit-backdrop-filter: blur(32px) saturate(2) brightness(1.1) !important;
 border: 1px solid rgba(255,255,255,0.7) !important;
 box-shadow: 0 24px 64px rgba(0,0,0,0.08), inset 0 1px 1px rgba(255,255,255,0.8) !important;
 border-radius: 24px !important;
 font-family: 'Inter', sans-serif !important;
 padding: 16px !important;
 width: 340px !important;
 box-sizing: border-box !important;
 }
 .flatpickr-innerContainer, .dayContainer {
 width: 100% !important;
 min-width: 100% !important;
 max-width: 100% !important;
 }
 .flatpickr-calendar:before, .flatpickr-calendar:after { display: none !important; }
 .flatpickr-day { border-radius: 12px !important; color: #1b1b1d !important; font-weight: 500; }
 .flatpickr-day:hover, .flatpickr-day:focus { background: rgba(255,255,255,0.8) !important; border-color: rgba(255,255,255,0.8) !important; }
 .flatpickr-day.selected, .flatpickr-day.selected:hover { background: #0058bc !important; color: white !important; border-color: #0058bc !important; box-shadow: 0 4px 12px rgba(0,88,188,0.3) !important; font-weight: 600; }
 .flatpickr-months .flatpickr-month { color: #1b1b1d !important; fill: #1b1b1d !important; }
 .flatpickr-current-month .flatpickr-monthDropdown-months { 
 background: transparent !important; 
 border-radius: 8px !important; 
 padding: 2px 4px !important; 
 outline: none !important;
 border: 1px solid transparent !important;
 transition: all 0.2s;
 cursor: pointer;
 }
 .flatpickr-current-month .flatpickr-monthDropdown-months:hover {
 background: rgba(255,255,255,0.4) !important;
 }
 .flatpickr-current-month .flatpickr-monthDropdown-months:focus {
 outline: none !important;
 box-shadow: 0 0 0 2px rgba(0, 88, 188, 0.3) !important;
 }
 .flatpickr-current-month .flatpickr-monthDropdown-months option { background: white; color: black; }
 span.flatpickr-weekday { color: #414755 !important; font-weight: 600 !important; }
 
 /* Year Input Styling */
 .flatpickr-current-month input.cur-year {
 background: transparent !important;
 border-radius: 8px !important;
 padding: 2px 4px !important;
 outline: none !important;
 border: 1px solid transparent !important;
 transition: all 0.2s;
 cursor: pointer;
 }
 .flatpickr-current-month input.cur-year:hover {
 background: rgba(255,255,255,0.4) !important;
 }
 .flatpickr-current-month input.cur-year:focus {
 outline: none !important;
 box-shadow: 0 0 0 2px rgba(0, 88, 188, 0.3) !important;
 }
 
 /* Open Animation */
 @keyframes fpFadeInDown {
 from { opacity: 0; transform: translateY(-10px) scale(0.98); }
 to { opacity: 1; transform: translateY(0) scale(1); }
 }
 .flatpickr-calendar.open {
 animation: fpFadeInDown 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
 }

 .flatpickr-input[type="text"] {
 background: rgba(255,255,255,0.35) !important;
 backdrop-filter: blur(20px) saturate(1.8) brightness(1.05) !important;
 -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05) !important;
 border: 1px solid rgba(255,255,255,0.6) !important;
 }
 </style>
 <!-- Tailwind CSS -->
 <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
 <!-- Tailwind Config -->
 <script id="tailwind-config">
 tailwind.config = {
 darkMode: "class",
 theme: {
 extend: {
 "colors": {
 "on-tertiary": "#ffffff",
 "surface": "#fcf8fb",
 "on-secondary-container": "#00732a",
 "tertiary-fixed-dim": "#ffb595",
 "surface-bright": "#fcf8fb",
 "on-tertiary-fixed-variant": "#7c2e00",
 "inverse-on-surface": "#f3f0f2",
 "secondary": "#006e28",
 "on-primary-container": "#fefcff",
 "secondary-fixed-dim": "#53e16f",
 "surface-container-high": "#eae7ea",
 "primary": "#0058bc",
 "background": "#fcf8fb",
 "secondary-fixed": "#72fe88",
 "error-container": "#ffdad6",
 "on-background": "#1b1b1d",
 "tertiary-container": "#c64f00",
 "surface-dim": "#dcd9dc",
 "primary-container": "#0070eb",
 "tertiary-fixed": "#ffdbcc",
 "on-tertiary-container": "#fffbff",
 "surface-container-lowest": "#ffffff",
 "on-primary-fixed": "#001a41",
 "error": "#ba1a1a",
 "on-primary": "#ffffff",
 "on-secondary": "#ffffff",
 "outline": "#717786",
 "secondary-container": "#6ffb85",
 "surface-tint": "#005bc1",
 "on-error-container": "#93000a",
 "primary-fixed": "#d8e2ff",
 "surface-container": "#f0edef",
 "inverse-surface": "#303032",
 "on-error": "#ffffff",
 "on-surface-variant": "#414755",
 "on-primary-fixed-variant": "#004493",
 "on-surface": "#1b1b1d",
 "surface-container-low": "#f6f3f5",
 "on-secondary-fixed-variant": "#00531c",
 "surface-variant": "#e4e2e4",
 "on-secondary-fixed": "#002107",
 "inverse-primary": "#adc6ff",
 "outline-variant": "#c1c6d7",
 "primary-fixed-dim": "#adc6ff",
 "tertiary": "#9e3d00",
 "on-tertiary-fixed": "#351000",
 "surface-container-highest": "#e4e2e4"
 },
 "borderRadius": {
 "DEFAULT": "1rem",
 "lg": "2rem",
 "xl": "3rem",
 "full": "9999px"
 },
 "spacing": {
 "gutter": "24px",
 "margin-mobile": "20px",
 "margin-desktop": "48px",
 "unit": "4px",
 "container-max": "1640px"
 },
 "fontFamily": {
 "headline-lg-mobile": ["Inter"],
 "display": ["Inter"],
 "body-lg": ["Inter"],
 "body-md": ["Inter"],
 "label-sm": ["Inter"],
 "headline-lg": ["Inter"],
 "headline-md": ["Inter"],
 "label-md": ["Inter"]
 },
 "fontSize": {
 "headline-lg-mobile": ["28px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "600"}],
 "display": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600"}],
 "body-lg": ["18px", {"lineHeight": "1.5", "letterSpacing": "-0.005em", "fontWeight": "500"}],
 "body-md": ["16px", {"lineHeight": "1.5", "letterSpacing": "0", "fontWeight": "500"}],
 "label-sm": ["12px", {"lineHeight": "1.4", "letterSpacing": "0.02em", "fontWeight": "600"}],
 "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.015em", "fontWeight": "600"}],
 "headline-md": ["24px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600"}],
 "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "600"}]
 }
 }
 }
 }
 </script>
 <style>
 /* Utility for Material Symbols */
 .material-symbols-outlined {
 font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
 }
 
 /* Liquid Glass Base Class */
 .liquid-glass {
 background-color: rgba(255, 255, 255, 0.45);
 backdrop-filter: blur(40px);
 -webkit-backdrop-filter: blur(40px);
 border: 1px solid rgba(255, 255, 255, 0.6);
 box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03), 0 20px 40px rgba(0, 0, 0, 0.04), inset 0 1px 0 rgba(255, 255, 255, 0.8);
 }
 
 /* Soft mesh background elements via tailwind arbitrary values are forbidden, 
 so we use inline styles for the complex blurred blobs to strictly follow rules while achieving the look */
 .mesh-blob-1 { background-color: #d8e2ff; filter: blur(100px); } /* primary-fixed */
 .mesh-blob-2 { background-color: #ffdbcc; filter: blur(120px); } /* tertiary-fixed */
 .mesh-blob-3 { background-color: #72fe88; filter: blur(140px); opacity: 0.3; } /* secondary-fixed */
 </style>
 @vite(['resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container overflow-x-hidden overflow-y-scroll relative">
 
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

 <div class="flex min-h-screen w-full">
 <!-- Shared Component: SideNavBar -->
 <x-sidebar />

 <!-- Main Content Area -->
 <main class="slide-up-content flex-1 w-full md:ml-[360px] p-margin-mobile md:p-margin-desktop max-w-container-max mx-auto">
 <!-- Topbar -->
 <x-topbar />
 
 <div class="space-y-8 mt-6">
 {{ $slot }}
 </div>
 <div class="pb-12"></div>
 </main>
 </div>
 <!-- Flatpickr JS -->
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 <script>
 document.addEventListener("DOMContentLoaded", function() {
 flatpickr("input[type=date]", {
 dateFormat: "Y-m-d",
 altInput: true,
 altFormat: "d M Y",
 disableMobile: "true",
 monthSelectorType: "static"
 });
 });
 
 // Page Transition Logic
 let isPageLoaded = false;
 window.addEventListener("load", function () {
 isPageLoaded = true;
 setTimeout(() => { // Sedikit delay agar transisi lebih terasa 'mahal'
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
 !link.href.includes('#')
 ) {
 e.preventDefault();
 document.body.classList.remove("page-loaded");
 document.body.classList.add("page-leaving");
 setTimeout(() => {
 window.location = link.href;
 }, 500); // 500ms mengikuti durasi CSS 0.6s
 }
 });
 });
 });
 </script>
</body>
</html>
