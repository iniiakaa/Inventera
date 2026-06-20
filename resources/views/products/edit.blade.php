<x-layouts.admin active="products" title="Edit Produk - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Master Data</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Edit Produk: {{ $product->name }}</h2>
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

 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-4xl">
 <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-6">
 @csrf
 @method('PUT')
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <!-- Info Dasar -->
 <div class="space-y-6">
 <h3 class="font-title-md text-on-surface border-b border-gray-100 pb-2">Informasi Dasar</h3>
 
 <div class="space-y-2">
 <label for="name" class="block font-label-md text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
 <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="category_id" class="block font-label-md text-gray-700">Kategori <span class="text-red-500">*</span></label>
 <x-select id="category_id" name="category_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 @foreach($categories as $category)
 <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
 @endforeach
 </x-select>
 </div>

 <div class="space-y-2">
 <label for="description" class="block font-label-md text-gray-700">Deskripsi (Opsional)</label>
 <textarea id="description" name="description" rows="3" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-gray-50/50">{{ old('description', $product->description) }}</textarea>
 </div>
 </div>

 <!-- Info Harga & Identitas -->
 <div class="space-y-6">
 <h3 class="font-title-md text-on-surface border-b border-gray-100 pb-2">Harga & Identitas</h3>
 
 <div class="grid grid-cols-2 gap-4">
 <div class="space-y-2">
 <label for="cost_price" class="block font-label-md text-gray-700">Harga Beli (Rp) <span class="text-red-500">*</span></label>
 <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" required min="0" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary text-right font-body-md bg-gray-50/50">
 </div>
 <div class="space-y-2">
 <label for="selling_price" class="block font-label-md text-gray-700">Harga Jual (Rp) <span class="text-red-500">*</span></label>
 <input type="number" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required min="0" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary text-right font-body-md bg-gray-50/50">
 </div>
 </div>

 <div class="grid grid-cols-2 gap-4">
 <div class="space-y-2">
 <label for="sku" class="block font-label-md text-gray-700">SKU <span class="text-red-500">*</span></label>
 <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-gray-50/50">
 </div>
 <div class="space-y-2">
 <label for="unit" class="block font-label-md text-gray-700">Satuan Jual <span class="text-red-500">*</span></label>
 <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit) }}" required 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-gray-50/50">
 </div>
 </div>

 <div class="space-y-2">
 <label for="barcode" class="block font-label-md text-gray-700">Barcode (Opsional)</label>
 <input type="text" id="barcode" name="barcode" value="{{ old('barcode', $product->barcode) }}" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-gray-50/50">
 </div>

 <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-lg">
 <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
 class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
 <label for="is_active" class="font-label-md text-gray-700 cursor-pointer">Produk Aktif (Tampil di POS)</label>
 </div>
 </div>
 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all">Simpan Perubahan</button>
 </div>
 </form>
 </section>
</x-layouts.admin>
