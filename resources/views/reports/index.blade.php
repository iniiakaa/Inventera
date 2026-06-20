<x-layouts.admin active="reports" title="Laporan & Ekspor - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Laporan & Analitik</p>
 <h2 class="font-display text-display text-on-surface">Pusat Laporan</h2>
 </div>
 </header>

 @if(session('error'))
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 {{ session('error') }}
 </div>
 @endif

 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
 
 <!-- Laporan Penjualan -->
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
 <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
 <div class="p-3 bg-blue-50 text-primary rounded-lg">
 <span class="material-symbols-outlined text-[28px]">point_of_sale</span>
 </div>
 <div>
 <h3 class="font-title-lg text-on-surface">Laporan Penjualan</h3>
 <p class="text-sm text-gray-500 mt-1">Ekspor data riwayat transaksi POS.</p>
 </div>
 </div>

 <form action="{{ route('reports.sales') }}" method="POST" class="space-y-6">
 @csrf
 <div class="grid grid-cols-2 gap-4">
 <div class="space-y-2">
 <label for="start_date" class="block font-label-md text-gray-700">Tanggal Awal</label>
 <input type="date" id="start_date" name="start_date" value="{{ date('Y-m-01') }}" required 
 class="w-full px-4 py-2.5 rounded-full font-body-md text-on-surface-variant outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm cursor-pointer" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 </div>
 <div class="space-y-2">
 <label for="end_date" class="block font-label-md text-gray-700">Tanggal Akhir</label>
 <input type="date" id="end_date" name="end_date" value="{{ date('Y-m-t') }}" required 
 class="w-full px-4 py-2.5 rounded-full font-body-md text-on-surface-variant outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm cursor-pointer" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 </div>
 </div>

 <div class="space-y-2 border-t border-gray-100 pt-4 mt-2">
 <label class="block font-label-md text-gray-700">Pilih Format Ekspor</label>
 <div class="flex gap-4">
 <label class="flex items-center space-x-2 cursor-pointer">
 <input type="radio" name="export_type" value="pdf" checked class="text-primary focus:ring-primary">
 <span class="font-body-md text-gray-700 flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-red-500">picture_as_pdf</span> PDF</span>
 </label>
 <label class="flex items-center space-x-2 cursor-pointer">
 <input type="radio" name="export_type" value="excel" class="text-primary focus:ring-primary">
 <span class="font-body-md text-gray-700 flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-green-600">table_view</span> Excel (XLSX)</span>
 </label>
 </div>
 </div>

 <button type="submit" class="w-full py-3 bg-primary text-on-primary rounded-lg font-label-md shadow-md hover:bg-opacity-90 transition-all flex justify-center items-center gap-2">
 <span class="material-symbols-outlined text-[20px]">download</span>
 Download Laporan Penjualan
 </button>
 </form>
 </section>

 <!-- Laporan Stok -->
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
 <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
 <div class="p-3 bg-green-50 text-green-600 rounded-lg">
 <span class="material-symbols-outlined text-[28px]">inventory_2</span>
 </div>
 <div>
 <h3 class="font-title-lg text-on-surface">Laporan Stok Saat Ini</h3>
 <p class="text-sm text-gray-500 mt-1">Ekspor posisi kuantitas stok barang di gudang.</p>
 </div>
 </div>

 <form action="{{ route('reports.stocks') }}" method="POST" class="space-y-6">
 @csrf
 <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100 text-sm text-yellow-800 mb-4">
 Laporan stok akan menampilkan kondisi stok aktual pada saat tombol export ditekan (Real-time).
 </div>

 <div class="space-y-2 border-t border-gray-100 pt-4">
 <label class="block font-label-md text-gray-700">Pilih Format Ekspor</label>
 <div class="flex gap-4">
 <label class="flex items-center space-x-2 cursor-pointer">
 <input type="radio" name="export_type" value="pdf" checked class="text-primary focus:ring-primary">
 <span class="font-body-md text-gray-700 flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-red-500">picture_as_pdf</span> PDF</span>
 </label>
 <label class="flex items-center space-x-2 cursor-pointer">
 <input type="radio" name="export_type" value="excel" class="text-primary focus:ring-primary">
 <span class="font-body-md text-gray-700 flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-green-600">table_view</span> Excel (XLSX)</span>
 </label>
 </div>
 </div>

 <button type="submit" class="w-full py-3 bg-green-600 text-white rounded-lg font-label-md shadow-md hover:bg-green-700 transition-all flex justify-center items-center gap-2">
 <span class="material-symbols-outlined text-[20px]">download</span>
 Download Laporan Stok
 </button>
 </form>
 </section>

 </div>
</x-layouts.admin>
