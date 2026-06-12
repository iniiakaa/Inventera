<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RetailFlow - Owner Dashboard' }}</title>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
<body class="bg-surface text-on-surface font-body-md text-body-md min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container overflow-x-hidden relative">
    
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
        <main class="flex-1 w-full md:ml-[360px] p-margin-mobile md:p-margin-desktop max-w-container-max mx-auto">
            <div class="space-y-8">
                {{ $slot }}
            </div>
            <div class="pb-12"></div>
        </main>
    </div>
</body>
</html>
