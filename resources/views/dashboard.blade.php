<x-liquid-layout>
    <x-slot name="title">Store Overview</x-slot>

    <div class="space-y-8">
        <!-- Insight Cards (Bento Grid) -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-headline-md text-headline-md text-on-surface">Branch Performance</h3>
                <button class="font-label-md text-label-md text-primary flex items-center">View All <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_city</span>
                        </div>
                        <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-1">Jakarta (HQ)</p>
                        <p class="font-headline-md text-headline-md text-on-surface">Rp 4.2B</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-2 py-1 rounded-full">+8%</span>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-1">Bandung</p>
                        <p class="font-headline-md text-headline-md text-on-surface">Rp 2.8B</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <span class="bg-surface-variant text-on-surface-variant font-label-sm text-label-sm px-2 py-1 rounded-full">-2%</span>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-1">Surabaya</p>
                        <p class="font-headline-md text-headline-md text-on-surface">Rp 1.9B</p>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-2 py-1 rounded-full">+15%</span>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-1">Medan</p>
                        <p class="font-headline-md text-headline-md text-on-surface">Rp 3.1B</p>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface flex items-center justify-center">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-2 py-1 rounded-full">+4%</span>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-1">Makassar</p>
                        <p class="font-headline-md text-headline-md text-on-surface">Rp 1.2B</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Row: Chart & Alerts -->
        <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
            <!-- Main Chart Area -->
            <section class="xl:col-span-2 2xl:col-span-3 liquid-glass rounded-xl p-8 flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-surface">Revenue Trend</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Combined sales across all 5 branches</p>
                    </div>
                    <div class="flex bg-white/30 rounded-full p-1 border border-white/40">
                        <button class="px-4 py-1.5 rounded-full bg-white text-primary font-label-sm text-label-sm shadow-sm">1W</button>
                        <button class="px-4 py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm">1M</button>
                        <button class="px-4 py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm">1Y</button>
                    </div>
                </div>
                
                <div id="revenueChart" class="w-full h-[400px]"></div>
            </section>

            <!-- Stock Alerts & Quick Actions -->
            <section class="flex flex-col space-y-6 xl:col-span-1">
                <!-- Alerts Panel -->
                <div class="liquid-glass rounded-xl p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-headline-md text-headline-md text-on-surface">Critical Stock</h3>
                        <span class="w-8 h-8 rounded-full bg-error-container text-on-error-container flex items-center justify-center font-label-sm text-label-sm">3</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 p-3 rounded-lg hover:bg-white/30 transition-colors cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-error-container/50 text-error flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-label-md text-label-md text-on-surface truncate">Indomie Goreng</p>
                                <p class="font-body-md text-body-md text-on-surface-variant truncate">Jakarta Branch • 2 left</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-3 rounded-lg hover:bg-white/30 transition-colors cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-error-container/50 text-error flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-label-md text-label-md text-on-surface truncate">Beras Maknyus 5kg</p>
                                <p class="font-body-md text-body-md text-on-surface-variant truncate">Bandung Branch • 0 left</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-3 rounded-lg hover:bg-white/30 transition-colors cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-tertiary-container/20 text-tertiary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">inventory</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-label-md text-label-md text-on-surface truncate">Minyak Goreng 2L</p>
                                <p class="font-body-md text-body-md text-on-surface-variant truncate">Surabaya Branch • Low est.</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('inventory') }}" class="w-full mt-auto pt-6 block">
                        <div class="py-3 px-4 liquid-glass rounded-full text-primary font-label-md text-label-sm hover:bg-white/60 transition-all text-center">
                            Manage Inventory
                        </div>
                    </a>
                </div>
            </section>
        </div>
        <div class="pb-12"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof ApexCharts !== 'undefined') {
                var options = {
                    series: [{
                        name: 'Revenue',
                        data: [310, 400, 280, 510, 420, 109, 1000]
                    }],
                    chart: {
                        height: 400,
                        type: 'area',
                        fontFamily: 'Inter, sans-serif',
                        background: 'transparent',
                        toolbar: { show: false },
                        zoom: { enabled: false }
                    },
                    tooltip: { enabled: false },
                    colors: ['#0058bc'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 3 },
                    xaxis: {
                        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { style: { colors: '#717786' } }
                    },
                    yaxis: {
                        labels: { style: { colors: '#717786' }, formatter: (value) => { return 'Rp ' + value + 'M' } }
                    },
                    grid: {
                        borderColor: 'rgba(255,255,255,0.2)',
                        strokeDashArray: 4,
                        yaxis: { lines: { show: true } },
                        xaxis: { lines: { show: false } }
                    },
                    theme: { mode: 'light' }
                };

                var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
                chart.render();
            }
        });
    </script>
</x-liquid-layout>
