<!-- Page Header -->
<header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
    <div>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-0">Good morning, {{ Auth::user()->name ?? 'Pak Jayusman' }}</p>
        <h2 class="font-display text-display text-on-surface hidden md:block">{{ $title ?? 'Store Overview' }}</h2>
        <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface md:hidden">{{ $title ?? 'Store Overview' }}</h2>
    </div>
    <div class="flex items-center space-x-4">
        <x-search-dropdown />
        <x-notif-dropdown />
        <div class="w-12 h-12 rounded-full bg-primary-container overflow-hidden border-2 border-white/50 shadow-sm cursor-pointer">
            <img alt="Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Jayusman') }}&color=7F9CF5&background=EBF4FF">
        </div>
    </div>
</header>
