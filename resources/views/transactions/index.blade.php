<x-layouts.admin active="transactions" title="Transactions - Jayusman Retail Management">
    <!-- Page Header -->
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
        <div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Financial Ledger</p>
            <h2 class="font-display text-display text-on-surface hidden md:block">Transactions</h2>
            <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface md:hidden">Transactions</h2>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-5 py-2.5 liquid-glass rounded-full font-label-md text-label-md text-on-surface hover:bg-white/60 transition-all flex items-center space-x-2">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Export CSV</span>
            </button>
            <button class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2">
                <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                <span>Advanced Filters</span>
            </button>
        </div>
    </header>

    <!-- Chart & Volume Row -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
        <!-- Cash Flow Chart -->
        <section class="xl:col-span-2 liquid-glass rounded-xl p-8 flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Cash Flow Overview</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Weekly transaction activity</p>
                </div>
                <div class="flex bg-white/30 rounded-full p-1 border border-white/40">
                    <button class="px-4 py-1.5 rounded-full bg-white text-primary font-label-sm text-label-sm shadow-sm">7D</button>
                    <button class="px-4 py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm">30D</button>
                </div>
            </div>
            <!-- Bar Chart Visual -->
            <div class="flex-1 flex items-end gap-3 h-40 mt-4">
                @php $bars = [40, 70, 55, 90, 60, 75, 45]; $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']; @endphp
                @foreach($bars as $i => $h)
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full rounded-t-lg bg-gradient-to-t from-primary to-primary/40" style="height: {{ $h }}%;"></div>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $days[$i] }}</span>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Monthly Volume -->
        <section class="liquid-glass rounded-xl p-8 flex flex-col justify-between">
            <div>
                <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-3 py-1.5 rounded-full">Monthly Volume</span>
                <p class="font-display text-display text-on-surface mt-4">Rp 1.2M</p>
                <p class="font-body-md text-body-md text-secondary mt-2 flex items-center">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span>
                    +14.2% from last month
                </p>
            </div>
            <div class="pt-6 border-t border-white/20">
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Next Settlement</p>
                <p class="font-body-md text-body-md text-on-surface mt-1">May 05, 2026 • 23:59 WIB</p>
            </div>
        </section>
    </div>

    <!-- Transaction History Table -->
    <section class="liquid-glass rounded-xl overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-white/20">
            <h3 class="font-headline-md text-headline-md text-on-surface">Transaction History</h3>
            <p class="font-label-sm text-label-sm text-on-surface-variant">Showing 2,401 operations</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/10">
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Transaction Source</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-center">Amount</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    <tr class="hover:bg-white/10 transition-colors cursor-pointer">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">shopping_bag</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface">Merchant Payment: PT Tokopedia</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">ID: TXN-99201-BETA</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-3 py-1 rounded-full">Cleared</span>
                        </td>
                        <td class="px-6 py-5 text-center font-label-md text-label-md text-on-surface">-Rp 21.3jt</td>
                        <td class="px-6 py-5 text-right font-label-sm text-label-sm text-on-surface-variant">20:34:11</td>
                    </tr>
                    <tr class="hover:bg-white/10 transition-colors cursor-pointer">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-xl bg-tertiary-fixed/30 text-tertiary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">payments</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface">Incoming Wire: PT Sinar Plastik</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">ID: TXN-00219-WIRE</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="bg-error-container text-error font-label-sm text-label-sm px-3 py-1 rounded-full">Pending</span>
                        </td>
                        <td class="px-6 py-5 text-center font-label-md text-label-md text-secondary">+Rp 187.5jt</td>
                        <td class="px-6 py-5 text-right font-label-sm text-label-sm text-on-surface-variant">19:42:01</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="flex justify-center items-center gap-2 p-6 border-t border-white/20">
            <button class="w-8 h-8 rounded-full liquid-glass flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[16px]">chevron_left</span>
            </button>
            <span class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-md text-label-md">1</span>
            <span class="w-8 h-8 rounded-full flex items-center justify-center font-label-md text-label-md text-on-surface-variant hover:text-on-surface cursor-pointer">2</span>
            <span class="w-8 h-8 rounded-full flex items-center justify-center font-label-md text-label-md text-on-surface-variant hover:text-on-surface cursor-pointer">3</span>
            <button class="w-8 h-8 rounded-full liquid-glass flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            </button>
        </div>
    </section>
    <div class="pb-12"></div>
</x-layouts.admin>