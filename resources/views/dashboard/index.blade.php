<x-layouts.admin active="dashboard" title="Dashboard - Inventera">
 <div class="space-y-8">

 <!-- ROLE: OWNER & MANAGER (Revenue & Branches) -->
 @if(in_array($role, ['owner', 'manager']))
 <section>
 <div class="flex items-center justify-between mb-4">
 <h3 class="font-headline-md text-headline-md text-on-surface">
 {{ $role === 'owner' ? 'Performa Cabang (Bulan Ini)' : 'Performa Cabang Anda (Bulan Ini)' }}
 </h3>
 @if($role === 'owner')
 <a href="{{ route('branches.index') }}" class="font-label-md text-label-md text-primary flex items-center hover:underline">Kelola Cabang <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
 @endif
 </div>
 
 <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
 @forelse($branches as $branch)
 <div class="liquid-glass rounded-lg p-6 flex flex-col justify-between transition-transform duration-300 group hover:shadow-md">
 <div class="flex items-center justify-between mb-4">
 <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
 <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">store</span>
 </div>
 <span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-2 py-1 rounded-full">{{ $branch['growth'] > 0 ? '+' : '' }}{{ $branch['growth'] }}%</span>
 </div>
 <div>
 <p class="font-body-md text-body-md text-on-surface-variant mb-1">{{ $branch['name'] }}</p>
 <p class="font-headline-md text-[20px] font-bold text-on-surface">Rp {{ number_format($branch['revenue'], 0, ',', '.') }}</p>
 </div>
 </div>
 @empty
 <div class="col-span-full liquid-glass rounded-lg p-6 text-center text-gray-500">Belum ada data transaksi cabang bulan ini.</div>
 @endforelse
 </div>
 </section>
 
 <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
 <!-- Revenue Chart -->
 <section class="liquid-glass rounded-xl p-8 flex flex-col xl:col-span-2">
 <div class="flex items-center justify-between mb-8">
 <div>
 <h3 class="font-headline-md text-headline-md text-on-surface">Tren Pendapatan</h3>
 <p class="font-body-md text-body-md text-on-surface-variant">
 {{ $role === 'owner' ? 'Total penjualan seluruh cabang, 7 hari terakhir' : 'Penjualan cabang Anda, 7 hari terakhir' }}
 </p>
 </div>
 </div>
 <div id="revenueChart" class="w-full" style="height: 300px; min-height: 300px;"></div>
 </section>

 <!-- Alerts Panel -->
 <section class="liquid-glass rounded-xl p-6 flex flex-col">
 <div class="flex items-center justify-between mb-6">
 <h3 class="font-headline-md text-headline-md text-on-surface">Stok Kritis</h3>
 @if(count($critical_stock) > 0)
 <span class="w-8 h-8 rounded-full bg-error-container text-on-error-container flex items-center justify-center font-label-sm text-label-sm">{{ count($critical_stock) }}</span>
 @endif
 </div>
 <div class="space-y-4 flex-1">
 @forelse($critical_stock as $stock)
 <div class="flex items-start space-x-4 p-3 rounded-lg bg-gray-50/50 hover:bg-gray-100 transition-colors border border-gray-100">
 <div class="w-10 h-10 rounded-full {{ $stock['status'] == 'critical' ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600' }} flex items-center justify-center flex-shrink-0">
 <span class="material-symbols-outlined">warning</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface truncate">{{ $stock['name'] }}</p>
 <p class="font-body-sm text-body-sm text-on-surface-variant truncate">{{ $stock['branch'] }} • Sisa: {{ $stock['quantity'] }}</p>
 </div>
 </div>
 @empty
 <div class="text-center text-gray-500 font-body-md py-8">Semua stok cabang aman.</div>
 @endforelse
 </div>
 @if(in_array($role, ['manager']))
 <a href="{{ route('inventory.index') }}" class="w-full mt-4 pt-4 border-t border-gray-100 block">
 <div class="py-2.5 px-4 rounded-full bg-gray-50 text-primary font-label-md hover:bg-gray-100 transition-all text-center">
 Lihat Inventaris
 </div>
 </a>
 @endif
 </section>
 </div>
 @endif

 <!-- ROLE: SUPERVISOR (Quick Actions & Stock Alerts) -->
 @if($role === 'supervisor')
 <section class="grid grid-cols-1 xl:grid-cols-3 gap-8">
 <!-- Quick Actions -->
 <div class="xl:col-span-2 liquid-glass rounded-xl p-8">
 <h3 class="font-headline-md text-headline-md text-on-surface mb-6">Akses Cepat Operasional</h3>
 <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
 <a href="{{ route('inventory.index') }}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-white/60 hover:bg-white border border-gray-200 text-center transition-all hover:shadow-sm">
 <span class="material-symbols-outlined text-[40px] text-primary mb-3">inventory_2</span>
 <span class="font-label-md text-gray-800">Cek Inventaris</span>
 </a>
 <a href="{{ route('inventory.create') }}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-white/60 hover:bg-white border border-gray-200 text-center transition-all hover:shadow-sm">
 <span class="material-symbols-outlined text-[40px] text-green-600 mb-3">add_box</span>
 <span class="font-label-md text-gray-800">Barang Masuk</span>
 </a>
 <a href="{{ route('stock-opnames.index') }}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-white/60 hover:bg-white border border-gray-200 text-center transition-all hover:shadow-sm">
 <span class="material-symbols-outlined text-[40px] text-orange-600 mb-3">fact_check</span>
 <span class="font-label-md text-gray-800">Stock Opname</span>
 </a>
 <a href="{{ route('purchase-orders.index') }}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-white/60 hover:bg-white border border-gray-200 text-center transition-all hover:shadow-sm">
 <span class="material-symbols-outlined text-[40px] text-blue-600 mb-3">local_shipping</span>
 <span class="font-label-md text-gray-800">Purchase Order</span>
 </a>
 <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-white/60 hover:bg-white border border-gray-200 text-center transition-all hover:shadow-sm">
 <span class="material-symbols-outlined text-[40px] text-teal-600 mb-3">category</span>
 <span class="font-label-md text-gray-800">Master Produk</span>
 </a>
 </div>
 </div>

 <!-- Alerts -->
 <div class="liquid-glass rounded-xl p-6 flex flex-col">
 <div class="flex items-center justify-between mb-6">
 <h3 class="font-headline-md text-headline-md text-on-surface">Peringatan Stok</h3>
 @if(count($critical_stock) > 0)
 <span class="w-8 h-8 rounded-full bg-error-container text-on-error-container flex items-center justify-center font-label-sm text-label-sm">{{ count($critical_stock) }}</span>
 @endif
 </div>
 <div class="space-y-3 flex-1">
 @forelse($critical_stock as $stock)
 <div class="flex items-start space-x-3 p-3 rounded-lg bg-gray-50/50 border border-gray-100">
 <div class="w-8 h-8 rounded-full {{ $stock['status'] == 'critical' ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600' }} flex items-center justify-center flex-shrink-0">
 <span class="material-symbols-outlined text-[16px]">warning</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface truncate">{{ $stock['name'] }}</p>
 <p class="font-body-sm text-body-sm text-on-surface-variant truncate">Sisa: {{ $stock['quantity'] }}</p>
 </div>
 </div>
 @empty
 <div class="text-center text-gray-500 font-body-md py-8">Stok aman. Tidak ada peringatan.</div>
 @endforelse
 </div>
 <a href="{{ route('inventory.index') }}" class="w-full mt-4 pt-4 border-t border-gray-100 block">
 <div class="py-2.5 px-4 rounded-full bg-gray-50 text-primary font-label-md hover:bg-gray-100 transition-all text-center">
 Kelola Inventaris
 </div>
 </a>
 </div>
 </section>
 @endif

 <div class="pb-12"></div>
 </div>

 @if(in_array($role, ['owner', 'manager']))
 <script>
 document.addEventListener('DOMContentLoaded', function() {
 function initChart() {
 // Wait until ApexCharts is available (CDN may load after DOMContentLoaded)
 if (typeof ApexCharts === 'undefined') {
 return setTimeout(initChart, 100);
 }

 var rawSeries = @json($revenue_series);
 var rawLabels = @json($revenue_labels);
 var prevSeries = @json($prev_revenue_series);

 // Jika semua nilai 0 pada keduanya, kosongkan agar noData tampil
 var allZero = rawSeries.every(function(v) { return v === 0; })
 && prevSeries.every(function(v) { return v === 0; });

 var options = {
 series: allZero ? [] : [
 { name: 'Bulan Ini', data: rawSeries },
 { name: 'Bulan Lalu', data: prevSeries }
 ],
 chart: {
 height: 300,
 type: 'area',
 fontFamily: 'Inter, sans-serif',
 background: 'transparent',
 toolbar: { show: false },
 zoom: { enabled: false },
 animations: { enabled: true, easing: 'easeinout', speed: 600 }
 },
 tooltip: {
 enabled: true,
 y: {
 formatter: function(val) {
 return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
 }
 }
 },
 colors: ['#0058bc', '#9e3d00'],
 fill: {
 type: 'gradient',
 gradient: {
 shadeIntensity: 1,
 opacityFrom: 0.35,
 opacityTo: 0.02,
 stops: [0, 90, 100]
 }
 },
 dataLabels: { enabled: false },
 stroke: { curve: 'smooth', width: [3, 2], dashArray: [0, 5] },
 legend: {
 show: true,
 position: 'top',
 horizontalAlign: 'right',
 labels: { colors: '#717786' },
 markers: { size: 6 }
 },
 xaxis: {
 categories: rawLabels,
 axisBorder: { show: false },
 axisTicks: { show: false },
 labels: { style: { colors: '#717786', fontSize: '11px' } }
 },
 yaxis: {
 min: 0,
 labels: {
 style: { colors: '#717786' },
 formatter: function(val) {
 if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'jt';
 if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'rb';
 return 'Rp ' + val;
 }
 }
 },
 grid: {
 borderColor: 'rgba(0,0,0,0.06)',
 strokeDashArray: 4,
 yaxis: { lines: { show: true } },
 xaxis: { lines: { show: false } }
 },
 noData: {
 text: 'Belum ada transaksi dalam 7 hari terakhir',
 align: 'center',
 verticalAlign: 'middle',
 style: { color: '#717786', fontSize: '14px' }
 },
 theme: { mode: 'light' }
 };

 var chart = new ApexCharts(document.querySelector('#revenueChart'), options);
 chart.render();
 }
 initChart();
 });
 </script>
 @endif
 </x-layouts.admin>
