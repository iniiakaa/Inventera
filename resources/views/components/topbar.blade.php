@php
 $hour = (int) now()->format('H');
 $greeting = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));
@endphp
@if(!request()->routeIs('pos'))
 <!-- Page Header -->
 <header class="flex justify-between items-center mb-8 relative z-50">
 <div>
 @if(request()->routeIs('dashboard'))
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-0">{{ $greeting }}, {{ Auth::user()->name ?? 'Pengguna' }}</p>
 <h2 class="font-display text-display text-on-surface hidden md:block">{{ $title ?? 'Store Overview' }}</h2>
 <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface md:hidden">{{ $title ?? 'Store Overview' }}</h2>
 @endif
 </div>
 <div class="flex items-center space-x-4">
 <x-search-dropdown />
 <x-notif-dropdown />
 </div>
 </header>
@endif
