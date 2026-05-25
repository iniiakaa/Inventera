<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - Jayusman Retail Management System</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#c64f00",
                        "surface-container-high": "#eae7ea",
                        "inverse-on-surface": "#f3f0f2",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#006e28",
                        "secondary-fixed": "#72fe88",
                        "inverse-primary": "#adc6ff",
                        "surface-container-highest": "#e4e2e4",
                        "primary-fixed": "#d8e2ff",
                        "primary": "#0058bc",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "surface-container-low": "#f6f3f5",
                        "surface-tint": "#005bc1",
                        "error-container": "#ffdad6",
                        "background": "#fcf8fb",
                        "surface": "#fcf8fb",
                        "surface-container": "#f0edef",
                        "on-tertiary-fixed-variant": "#7c2e00",
                        "on-tertiary-fixed": "#351000",
                        "secondary-fixed-dim": "#53e16f",
                        "primary-fixed-dim": "#adc6ff",
                        "inverse-surface": "#303032",
                        "tertiary-fixed-dim": "#ffb595",
                        "on-secondary-fixed-variant": "#00531c",
                        "surface-dim": "#dcd9dc",
                        "surface-variant": "#e4e2e4",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#fefcff",
                        "tertiary": "#9e3d00",
                        "on-surface": "#1b1b1d",
                        "outline": "#717786",
                        "on-tertiary-container": "#fffbff",
                        "on-error": "#ffffff",
                        "on-surface-variant": "#414755",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#c1c6d7",
                        "tertiary-fixed": "#ffdbcc",
                        "on-secondary-fixed": "#002107",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#001a41",
                        "on-background": "#1b1b1d",
                        "secondary-container": "#6ffb85",
                        "primary-container": "#0070eb",
                        "on-primary-fixed-variant": "#004493",
                        "on-secondary-container": "#00732a",
                        "surface-bright": "#fcf8fb"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1200px",
                        "gutter": "24px",
                        "margin-desktop": "48px",
                        "unit": "4px",
                        "margin-mobile": "20px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "display": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["14px", { "lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "1.4", "letterSpacing": "0.02em", "fontWeight": "600" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "display": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.015em", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "letterSpacing": "0", "fontWeight": "500" }],
                        "body-lg": ["18px", { "lineHeight": "1.5", "letterSpacing": "-0.005em", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background min-h-screen flex flex-col justify-center items-center px-margin-mobile md:px-margin-desktop relative overflow-hidden">
<!-- Abstract Background Elements for Depth -->
<div class="absolute top-[-10%] left-[-5%] w-[40vw] h-[40vw] rounded-full bg-primary-fixed/30 blur-[120px] pointer-events-none"></div>
<div class="absolute bottom-[-10%] right-[-5%] w-[50vw] h-[50vw] rounded-full bg-tertiary-fixed-dim/20 blur-[150px] pointer-events-none"></div>
<div class="w-full max-w-[480px] z-10">
<!-- Main Glass Card -->
<div class="bg-surface-container-lowest/40 backdrop-blur-[40px] rounded-lg border border-white/40 shadow-[0_4px_12px_rgba(0,0,0,0.05),0_20px_40px_rgba(0,0,0,0.05)] p-10 md:p-12 relative overflow-hidden">
<!-- Inner Glow Highlight -->
<div class="absolute inset-0 rounded-lg shadow-[inset_0_1px_0_rgba(255,255,255,0.6)] pointer-events-none"></div>
<!-- Branding -->
<div class="flex flex-col items-center mb-8">
<div class="w-16 h-16 bg-surface-container-lowest rounded-full flex items-center justify-center mb-4 shadow-[0_2px_8px_rgba(0,0,0,0.05)] border border-surface-variant">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">storefront</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-2 tracking-tight text-center">Jayusman Retail</h1>
<p class="font-body-md text-body-md text-on-surface-variant text-center">Masuk ke sistem manajemen Anda</p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="mb-4 font-body-md text-sm text-secondary">
        {{ session('status') }}
    </div>
@endif

<!-- Login Form -->
<form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <div class="space-y-2">
        <label class="font-label-md text-label-md text-on-surface block" for="email">Alamat Email</label>
        <div class="relative">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
            <input class="w-full bg-surface-container-lowest/50 border border-outline-variant rounded-full py-3 pl-12 pr-4 font-body-md text-body-md text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@perusahaan.com" type="email"/>
        </div>
        @error('email')
            <p class="text-error text-sm mt-1 font-body-md">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <div class="flex justify-between items-center">
            <label class="font-label-md text-label-md text-on-surface block" for="password">Kata Sandi</label>
        </div>
        <div class="relative">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
            <input class="w-full bg-surface-container-lowest/50 border border-outline-variant rounded-full py-3 pl-12 pr-12 font-body-md text-body-md text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="password" name="password" required autocomplete="current-password" placeholder="••••••••" type="password"/>
            <!-- Removing visibility toggle to keep it simple, or implementing it with inline alpinejs -->
        </div>
        @error('password')
            <p class="text-error text-sm mt-1 font-body-md">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface-container-lowest/50" id="remember" name="remember" type="checkbox"/>
        <label class="ml-3 font-body-md text-body-md text-on-surface-variant" for="remember">Ingat Saya</label>
    </div>

    <button class="w-full bg-primary text-on-primary font-label-md text-label-md py-4 rounded-full shadow-[0_4px_12px_rgba(0,88,188,0.2)] hover:bg-primary-container hover:shadow-[0_6px_16px_rgba(0,88,188,0.3)] transition-all active:scale-[0.98]" type="submit">
        Masuk
    </button>
</form>

</div>
<!-- Footer -->
<footer class="w-full py-8 mt-4 flex flex-col items-center justify-center gap-2">
<p class="font-label-sm text-label-sm text-on-surface-variant">
                © 2024 Jayusman Retail Systems. All rights reserved.
            </p>
<div class="flex gap-4">
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<span class="text-outline-variant">•</span>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Contact Support</a>
</div>
</footer>
</div>
</body></html>
