<x-layouts.admin active="inventory" title="Pengajuan Stock Opname - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('stock-opnames.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Manajemen Inventori</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Ajukan Stock Opname (Penyesuaian Fisik)</h2>
 </header>

 @if($errors->any())
 <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg font-body-md">
 <ul class="list-disc list-inside">
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 @if(session('error'))
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 {{ session('error') }}
 </div>
 @endif

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
 <form action="{{ route('stock-opnames.store') }}" method="POST" class="space-y-6">
 @csrf
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <div class="space-y-2 md:col-span-2">
 <label for="product_id" class="block font-label-md text-gray-700">Pilih Produk <span class="text-red-500">*</span></label>
 <x-select id="product_id" name="product_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Pilih Produk...</option>
 @foreach($products as $product)
 <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku }})</option>
 @endforeach
 </x-select>
 </div>

 <div class="space-y-2 md:col-span-2">
 <label for="physical_stock" class="block font-label-md text-gray-700">Jumlah Stok Fisik (Sebenarnya) <span class="text-red-500">*</span></label>
 <input type="number" id="physical_stock" name="physical_stock" value="{{ old('physical_stock') }}" required min="0" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2 md:col-span-2">
 <label for="reason" class="block font-label-md text-gray-700">Alasan Penyesuaian <span class="text-red-500">*</span></label>
 <textarea id="reason" name="reason" rows="3" required placeholder="Jelaskan alasan, misal: Barang kadaluarsa, salah hitung, atau hilang."
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">{{ old('reason') }}</textarea>
 </div>
 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('stock-opnames.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all">Ajukan Penyesuaian</button>
 </div>
 </form>
 </section>
</x-layouts.admin>
