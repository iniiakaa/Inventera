<x-layouts.admin active="inventory" title="Barang Masuk - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('inventory.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Gudang & Stok</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Tambah Barang Masuk</h2>
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

 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-2xl">
 <form action="{{ route('inventory.store') }}" method="POST" class="space-y-6">
 @csrf
 
 <div class="space-y-6">
 
 <div class="space-y-2">
 <label for="branch_id" class="block font-label-md text-gray-700">Cabang <span class="text-red-500">*</span></label>
 <x-select id="branch_id" name="branch_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 @if(count($branches) > 1)
 <option value="">Pilih Cabang</option>
 @endif
 @foreach($branches as $branch)
 <option value="{{ $branch->id }}" {{ old('branch_id', Auth::user()->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
 @endforeach
 </x-select>
 </div>

 <div class="space-y-2">
 <label for="product_id" class="block font-label-md text-gray-700">Produk <span class="text-red-500">*</span></label>
 <x-select id="product_id" name="product_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Cari Produk...</option>
 @foreach($products as $product)
 <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }} (SKU: {{ $product->sku }})</option>
 @endforeach
 </x-select>
 </div>

 <div class="space-y-2">
 <label for="quantity" class="block font-label-md text-gray-700">Jumlah Masuk (Qty) <span class="text-red-500">*</span></label>
 <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required min="1" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary text-right font-body-md bg-gray-50/50">
 <p class="text-xs text-gray-500 mt-1">Stok ini akan langsung ditambahkan ke inventaris cabang yang dipilih.</p>
 </div>

 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('inventory.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all flex items-center gap-2">
 <span class="material-symbols-outlined text-[18px]">save</span>
 <span>Proses Barang Masuk</span>
 </button>
 </div>
 </form>
 </section>
</x-layouts.admin>
