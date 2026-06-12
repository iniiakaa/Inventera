<x-layouts.admin active="reports" title="Reports - Jayusman Retail Management">
    <!-- Page Header -->
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
        <div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Intelligence Hub</p>
            <h2 class="font-display text-display text-on-surface hidden md:block">Reports</h2>
            <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface md:hidden">Reports</h2>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-5 py-2.5 liquid-glass rounded-full font-label-md text-label-md text-on-surface hover:bg-white/60 transition-all flex items-center space-x-2">
                <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                <span>Filters</span>
            </button>
            <button class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Generate Report</span>
            </button>
        </div>
    </header>

    <!-- Featured Report + Automation -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
        <!-- Featured Report -->
        <section class="xl:col-span-2 liquid-glass rounded-xl p-8 flex flex-col justify-between group hover:translate-y-[-2px] transition-transform duration-300">
            <div class="flex justify-between items-start">
                <span class="bg-primary/10 text-primary font-label-sm text-label-sm px-3 py-1.5 rounded-full">Quarterly Highlight</span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Oct 2025 - Dec 2025</span>
            </div>
            <div class="mt-6">
                <h3 class="font-headline-lg text-headline-lg text-on-surface leading-tight">Annual Operational Performance & Scaling Audit</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-3 max-w-lg leading-relaxed">A deep-dive into cross-functional efficiency and resource allocation across all regional clusters in Indonesia.</p>
            </div>
            <div class="mt-8 flex justify-between items-center">
                <div class="flex -space-x-2">
                    <img class="w-8 h-8 rounded-full border-2 border-white/60" src="https://ui-avatars.com/api/?name=Andi+P&background=0058bc&color=fff" alt="Andi P">
                    <img class="w-8 h-8 rounded-full border-2 border-white/60" src="https://ui-avatars.com/api/?name=Sari+W&background=006e28&color=fff" alt="Sari W">
                    <div class="w-8 h-8 rounded-full border-2 border-white/60 bg-surface-container flex items-center justify-center font-label-sm text-label-sm text-on-surface">+4</div>
                </div>
                <a href="#" class="text-primary font-label-md text-label-md flex items-center space-x-2 group-hover:underline">
                    <span>Download PDF</span>
                    <span class="material-symbols-outlined text-[18px]">download</span>
                </a>
            </div>
        </section>

        <!-- Automation Panel -->
        <section class="liquid-glass rounded-xl p-8 flex flex-col justify-between">
            <div>
                <span class="bg-tertiary-fixed/40 text-tertiary font-label-sm text-label-sm px-3 py-1.5 rounded-full">Automation</span>
                <h3 class="font-headline-md text-headline-md text-on-surface mt-6">Daily Health Check</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-3 leading-relaxed">System-wide diagnostic and uptime report generated automatically.</p>
            </div>
            <div class="flex justify-between items-center mt-8">
                <span class="font-label-sm text-label-sm text-on-surface-variant">2 hours ago</span>
                <button class="w-9 h-9 rounded-full liquid-glass flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                </button>
            </div>
        </section>
    </div>

    <!-- Historical Archive -->
    <section class="liquid-glass rounded-xl overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-white/20">
            <h3 class="font-headline-md text-headline-md text-on-surface">Historical Archive</h3>
            <p class="font-label-sm text-label-sm text-on-surface-variant">Showing 148 documents</p>
        </div>
        <div class="divide-y divide-white/10">
            @php
                $reports = [
                    ['title' => 'Q3 2025 Financial Integrity Assessment', 'file' => 'FIN_AUDIT_2025_Q3_FINAL.pdf', 'size' => '14.2 MB', 'author' => 'Reza Pratama'],
                    ['title' => 'Capital Market Volatility Prediction (CSV)', 'file' => 'ANALYTICS_EXPORT_BETA.csv', 'size' => '2.8 MB', 'author' => 'AI Engine'],
                    ['title' => 'Monthly Cash Reconciliation — March 2026', 'file' => 'RECONCILIATION_MAR2026.pdf', 'size' => '5.4 MB', 'author' => 'Sari Wulandari'],
                ];
            @endphp

            @foreach($reports as $report)
            <div class="flex items-center justify-between p-5 hover:bg-white/10 transition-colors cursor-pointer group">
                <div class="flex items-center space-x-4">
                    <div class="w-11 h-11 rounded-xl liquid-glass flex items-center justify-center text-on-surface-variant group-hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <p class="font-label-md text-label-md text-on-surface">{{ $report['title'] }}</p>
                        <p class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">{{ $report['file'] }} • {{ $report['size'] }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-8">
                    <div class="text-right">
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Author</p>
                        <p class="font-label-md text-label-md text-on-surface mt-0.5">{{ $report['author'] }}</p>
                    </div>
                    <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="w-9 h-9 rounded-full liquid-glass flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-[18px]">share</span>
                        </button>
                        <button class="w-9 h-9 rounded-full liquid-glass flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <div class="pb-12"></div>
</x-layouts.admin>
