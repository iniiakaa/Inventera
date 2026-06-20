<x-layouts.admin active="inventory" title="Detail Purchase Order - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('purchase-orders.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Manajemen Inventori</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Detail PO: {{ $purchaseOrder->po_number }}</h2>
 </header>

 @if(session('error'))
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 {{ session('error') }}
 </div>
 @endif

 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
 <div class="md:col-span-2 space-y-6">
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 overflow-hidden">
 <div class="p-4 border-b border-gray-100 bg-gray-50/50">
 <h3 class="font-title-md text-on-surface">Item yang Dipesan</h3>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-gray-50/50 border-b border-gray-200">
 <tr>
 <th class="p-4 font-label-md text-gray-600">Produk</th>
 <th class="p-4 font-label-md text-gray-600 text-right">Qty</th>
 <th class="p-4 font-label-md text-gray-600 text-right">Harga Satuan</th>
 <th class="p-4 font-label-md text-gray-600 text-right">Subtotal</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100">
 @foreach($purchaseOrder->items as $item)
 <tr>
 <td class="p-4">
 <p class="font-medium text-gray-800">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
 <p class="text-xs text-gray-500">SKU: {{ $item->product->sku ?? '-' }}</p>
 </td>
 <td class="p-4 text-right font-body-md">{{ $item->quantity_ordered }}</td>
 <td class="p-4 text-right font-body-md">Rp {{ number_format($item->unit_cost, 0, ',', '.') }}</td>
 <td class="p-4 text-right font-medium text-primary">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
 </tr>
 @endforeach
 </tbody>
 <tfoot class="bg-gray-50">
 <tr>
 <td colspan="3" class="p-4 text-right font-label-md text-gray-700">Total Keseluruhan</td>
 <td class="p-4 text-right font-title-md text-primary">Rp {{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}</td>
 </tr>
 </tfoot>
 </table>
 </div>
 </section>
 </div>

 <div class="space-y-6">
 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6">
 <h3 class="font-title-md text-on-surface mb-4">Informasi PO</h3>
 <div class="space-y-3 font-body-md text-gray-700">
 <p><span class="text-gray-500 block text-sm">Cabang Pemesan:</span> {{ $purchaseOrder->branch->name }}</p>
 <p><span class="text-gray-500 block text-sm">Supplier:</span> <span class="font-medium">{{ $purchaseOrder->supplier->name }}</span></p>
 <p><span class="text-gray-500 block text-sm">Tanggal Order:</span> {{ \Carbon\Carbon::parse($purchaseOrder->ordered_at)->format('d F Y') }}</p>
 <p><span class="text-gray-500 block text-sm">Status Saat Ini:</span> 
 <span class="inline-block mt-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 capitalize">{{ $purchaseOrder->status }}</span>
 </p>
 </div>
 </section>

 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6">
 <h3 class="font-title-md text-on-surface mb-4">Ubah Status</h3>
 
 @if($purchaseOrder->status === 'received')
 <div class="p-4 bg-green-50 text-green-800 rounded-lg text-sm">
 <p class="font-medium">PO Selesai</p>
 <p>Barang telah diterima dan stok sudah ditambahkan ke Inventory pada {{ \Carbon\Carbon::parse($purchaseOrder->received_at)->format('d/m/Y H:i') }}.</p>
 </div>
 @else
 <form action="{{ route('purchase-orders.update', $purchaseOrder->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin mengubah status ini? Jika Received, stok otomatis bertambah.')">
 @csrf
 @method('PUT')
 <div class="space-y-4">
 <x-select name="status" class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="draft" {{ $purchaseOrder->status === 'draft' ? 'selected' : '' }}>Draft</option>
 <option value="sent" {{ $purchaseOrder->status === 'sent' ? 'selected' : '' }}>Sent (Terkirim ke Supplier)</option>
 <option value="received" {{ $purchaseOrder->status === 'received' ? 'selected' : '' }}>Received (Terima & Tambah Stok)</option>
 <option value="cancelled" {{ $purchaseOrder->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
 </x-select>
 
 <button type="submit" class="w-full py-2.5 bg-primary text-on-primary rounded-lg font-label-md shadow-md hover:bg-opacity-90 transition-all">Simpan Status</button>
 </div>
 </form>
 @endif
 </section>
 </div>
 </div>
</x-layouts.admin>
