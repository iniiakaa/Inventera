<!-- Shared Component: SideNavBar -->
<nav class="hidden md:flex flex-col p-6 space-y-4 bg-white/10 dark:bg-black/10 backdrop-blur-[40px] border-white/20 dark:border-white/10 shadow-[4px_0_40px_rgba(0,0,0,0.05)] fixed w-[280px] z-50 top-[48px] left-[48px] h-[calc(100vh-96px)] rounded-[32px] border">
    <!-- Header -->
    <div class="flex items-center space-x-4 mb-8 px-2">
        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary-container to-primary flex items-center justify-center shadow-md">
            <span class="material-symbols-outlined text-on-primary text-headline-md font-headline-md">storefront</span>
        </div>
        <div>
            <h1 class="font-headline-md text-headline-md font-black text-primary dark:text-primary-fixed-dim">Inventera</h1>
            <p class="font-label-sm text-label-sm text-on-surface-variant">Premium Retail Mgmt</p>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex-1 space-y-2">
        <!-- Active: Dashboard -->
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5 hover:translate-x-1' }} rounded-xl transition-all duration-300" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('pos') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5 hover:translate-x-1' }} rounded-xl transition-all duration-300" href="{{ route('pos') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('pos') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">payments</span>
            <span class="font-label-md text-label-md">Sales</span>
        </a>
        
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('inventory') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5 hover:translate-x-1' }} rounded-xl transition-all duration-300" href="{{ route('inventory') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('inventory') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">inventory_2</span>
            <span class="font-label-md text-label-md">Inventory</span>
        </a>
    </div>
    
    <!-- Footer Area -->
    <div class="space-y-4 pt-4 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="flex items-center space-x-4 px-4 py-2 text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5 rounded-xl transition-all duration-300" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-md text-label-md">Logout</span>
            </a>
        </form>
    </div>
</nav>
