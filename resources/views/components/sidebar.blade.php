<!-- Shared Component: SideNavBar -->
@php $role = Auth::user()->role ?? ''; @endphp
<nav class="hidden md:flex flex-col p-6 space-y-4 bg-white/10 dark:bg-black/10 backdrop-blur-[40px] border-white/20 dark:border-white/10 shadow-[4px_0_40px_rgba(0,0,0,0.05)] fixed w-[280px] z-50 top-[48px] left-[48px] h-[calc(100vh-96px)] rounded-[32px] border">
    <!-- Header -->
    <div class="flex items-center space-x-4 mb-8 px-2">
        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary-container to-primary flex items-center justify-center shadow-md">
            <span class="material-symbols-outlined text-on-primary text-headline-md font-headline-md">storefront</span>
        </div>
        <div>
            <h1 class="font-headline-md text-headline-md font-black text-primary dark:text-primary-fixed-dim">Inventera</h1>
            <p class="font-label-sm text-label-sm text-on-surface-variant">Jayusman Retail</p>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex-1 space-y-2 overflow-y-auto">
        {{-- Dashboard: owner, manager, supervisor --}}
        @if(in_array($role, ['owner', 'manager', 'supervisor']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        @endif

        {{-- POS / Sales: cashier only (UC-09, UC-10, UC-11) --}}
        @if(in_array($role, ['cashier']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('pos') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('pos') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('pos') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">payments</span>
            <span class="font-label-md text-label-md">Sales</span>
        </a>
        @endif

        {{-- Inventory: warehouse, supervisor, manager (UC-05, UC-06, UC-07, UC-08) --}}
        @if(in_array($role, ['warehouse', 'supervisor', 'manager']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('inventory') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('inventory') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('inventory') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">inventory_2</span>
            <span class="font-label-md text-label-md">Inventory</span>
        </a>
        @endif

        {{-- Transactions: owner, manager (UC-13) --}}
        @if(in_array($role, ['owner', 'manager']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('transactions') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('transactions') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('transactions') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">point_of_sale</span>
            <span class="font-label-md text-label-md">Transaksi</span>
        </a>
        @endif

        {{-- Reports: owner, manager (UC-13, UC-14, UC-16) --}}
        @if(in_array($role, ['owner', 'manager']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('reports') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('reports') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('reports') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">assessment</span>
            <span class="font-label-md text-label-md">Laporan</span>
        </a>
        @endif

        {{-- Employees: owner, manager (UC-03) --}}
        @if(in_array($role, ['owner', 'manager']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('employees') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('employees') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('employees') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">badge</span>
            <span class="font-label-md text-label-md">Karyawan</span>
        </a>
        @endif

        {{-- Branches: owner only (UC-02) --}}
        @if(in_array($role, ['owner']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('branches.*') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('branches.index') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('branches.*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">store</span>
            <span class="font-label-md text-label-md">Cabang</span>
        </a>
        @endif

        {{-- Customers: owner, manager --}}
        @if(in_array($role, ['owner', 'manager']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('customers') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('customers') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('customers') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">group</span>
            <span class="font-label-md text-label-md">Pelanggan</span>
        </a>
        @endif

        {{-- Audit Log: owner only (UC-15) --}}
        @if(in_array($role, ['owner']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('audit-log') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('audit-log') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('audit-log') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">manage_history</span>
            <span class="font-label-md text-label-md">Audit Log</span>
        </a>
        @endif
    </div>
    
    <!-- Footer Area -->
    <div class="space-y-4 pt-4 border-t border-white/20">
        {{-- Settings: owner only (UC-02, UC-04) --}}
        @if(in_array($role, ['owner']))
        <a class="flex items-center space-x-4 px-4 py-3 {{ request()->routeIs('settings') ? 'bg-primary text-on-primary shadow-[0_8px_16px_rgba(0,88,188,0.3)]' : 'text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-white/10 dark:hover:bg-white/5' }} rounded-xl transition-all duration-300" href="{{ route('settings') }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('settings') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">settings</span>
            <span class="font-label-md text-label-md">Pengaturan</span>
        </a>
        @endif

        <!-- User Profile -->
        <div class="flex items-center gap-3 px-2 mb-4">
            <div class="w-10 h-10 rounded-full bg-primary-container overflow-hidden border-2 border-white/50 shadow-sm flex-shrink-0">
                <img alt="Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Jayusman') }}&color=7F9CF5&background=EBF4FF">
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-md text-label-md text-on-surface truncate">{{ Auth::user()->name ?? 'Jayusman' }}</span>
                <span class="font-body-sm text-body-sm text-on-surface-variant truncate capitalize">{{ Auth::user()->role ?? 'Role' }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="flex items-center space-x-4 px-4 py-2 text-on-surface-variant/80 dark:text-surface-variant/80 hover:bg-error/10 hover:text-error rounded-xl transition-all duration-300 group" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="material-symbols-outlined group-hover:text-error transition-colors">logout</span>
                <span class="font-label-md text-label-md group-hover:text-error transition-colors">Logout</span>
            </a>
        </form>
    </div>
</nav>
