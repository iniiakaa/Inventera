<x-layouts.admin active="inventory" title="Detail Stock Opname - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('stock-opnames.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Manajemen Inventori</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Detail Pengajuan Stock Opname</h2>
 </header>

 @if(session('error'))
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 {{ session('error') }}
 </div>
 @endif

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
 <h3 class="font-title-md text-on-surface border-b border-gray-100 pb-2">Informasi Pengajuan</h3>
 <div class="space-y-3 font-body-md text-gray-700">
 <p><span class="text-gray-500 block text-sm">Produk:</span> <span class="font-medium text-lg">{{ $stockOpname->product->name }}</span> (SKU: {{ $stockOpname->product->sku }})</p>
 <p><span class="text-gray-500 block text-sm">Pemohon (Staff):</span> {{ $stockOpname->user->name }}</p>
 <p><span class="text-gray-500 block text-sm">Cabang:</span> {{ $stockOpname->branch->name }}</p>
 <p><span class="text-gray-500 block text-sm">Tanggal Pengajuan:</span> {{ \Carbon\Carbon::parse($stockOpname->created_at)->format('d F Y, H:i') }}</p>
 <div class="p-4 bg-gray-50 rounded-lg mt-2">
 <p class="text-sm text-gray-500 mb-1">Alasan Penyesuaian:</p>
 <p class="italic text-gray-800">"{{ $stockOpname->reason }}"</p>
 </div>
 </div>
 </section>

 <div class="space-y-6">
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6">
 <h3 class="font-title-md text-on-surface border-b border-gray-100 pb-2 mb-4">Rincian Perubahan Stok</h3>
 
 <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg bg-gray-50/50 mb-3">
 <span class="text-gray-600">Stok Sistem (Tercatat)</span>
 <span class="font-title-md text-gray-800">{{ $stockOpname->system_stock }}</span>
 </div>
 <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg bg-gray-50/50 mb-3">
 <span class="text-gray-600">Stok Fisik (Sebenarnya)</span>
 <span class="font-title-md text-gray-800">{{ $stockOpname->physical_stock }}</span>
 </div>
 <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg {{ $stockOpname->difference < 0 ? 'bg-red-50 text-red-700' : 'bg-green-50 text-green-700' }}">
 <span class="font-medium">Selisih Stok</span>
 <span class="font-title-md">{{ $stockOpname->difference > 0 ? '+'.$stockOpname->difference : $stockOpname->difference }}</span>
 </div>
 </section>

 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6">
 <h3 class="font-title-md text-on-surface mb-4">Persetujuan / Tindakan</h3>
 
 @if($stockOpname->status !== 'pending')
 <div class="p-4 {{ $stockOpname->status === 'approved' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }} rounded-lg text-sm">
 <p class="font-medium mb-1">Status: {{ strtoupper($stockOpname->status) }}</p>
 <p>Telah diproses oleh <strong>{{ $stockOpname->approver->name ?? '-' }}</strong> pada {{ \Carbon\Carbon::parse($stockOpname->updated_at)->format('d/m/Y H:i') }}.</p>
 </div>
 @else
 @if(in_array(Auth::user()->role, ['owner', 'manager', 'supervisor']))
 <form action="{{ route('stock-opnames.update', $stockOpname->id) }}" method="POST" class="space-y-4">
 @csrf
 @method('PUT')
 <p class="text-sm text-gray-600 mb-2">Sebagai <span class="font-medium capitalize">{{ Auth::user()->role }}</span>, Anda memiliki wewenang untuk memproses pengajuan ini.</p>
 
 <div class="flex gap-3">
 <button type="submit" name="status" value="rejected" class="flex-1 py-2.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg font-label-md transition-all text-center">Tolak Pengajuan</button>
 <button type="submit" name="status" value="approved" class="flex-1 py-2.5 bg-green-600 text-white hover:bg-green-700 shadow-md rounded-lg font-label-md transition-all text-center">Setujui & Sesuaikan</button>
 </div>
 </form>
 @else
 <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg text-sm">
 <p>Menunggu persetujuan Supervisor / Manager.</p>
 </div>
 @endif
 @endif
 </section>
 </div>
 </div>
</x-layouts.admin>
