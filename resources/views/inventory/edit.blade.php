<x-layouts.admin active="inventory" title="Edit Inventaris - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('inventory.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Gudang & Stok</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Penyesuaian Manual</h2>
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
 <form action="{{ route('inventory.update', $inventory->id) }}" method="POST" class="space-y-6">
 @csrf
 @method('PUT')
 
 <div class="space-y-6">
 
 <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mb-6">
 <p class="font-label-sm text-gray-500 mb-1">Produk</p>
 <p class="font-body-lg font-medium text-gray-800">{{ $inventory->product->name }} (SKU: {{ $inventory->product->sku }})</p>
 
 <p class="font-label-sm text-gray-500 mb-1 mt-3">Cabang</p>
 <p class="font-body-md text-gray-800">{{ $inventory->branch->name }}</p>
 </div>

 <div class="grid grid-cols-2 gap-4">
 <div class="space-y-2">
 <label for="stock" class="block font-label-md text-gray-700">Stok Sistem Saat Ini <span class="text-red-500">*</span></label>
 <input type="number" id="stock" name="stock" value="{{ old('stock', $inventory->stock) }}" required min="0" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary text-right font-body-md bg-gray-50/50">
 </div>
 
 <div class="space-y-2">
 <label for="min_stock" class="block font-label-md text-gray-700">Batas Minimum Alert <span class="text-red-500">*</span></label>
 <input type="number" id="min_stock" name="min_stock" value="{{ old('min_stock', $inventory->min_stock) }}" required min="0" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary text-right font-body-md bg-gray-50/50">
 </div>
 </div>

 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('inventory.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all flex items-center gap-2">
 <span class="material-symbols-outlined text-[18px]">save</span>
 <span>Simpan Perubahan</span>
 </button>
 </div>
 </form>
 </section>
</x-layouts.admin>
