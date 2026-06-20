@php 
 $userLogin = Auth::user();
@endphp
<x-layouts.admin active="inventory" title="Buat Purchase Order - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('purchase-orders.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Manajemen Inventori</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Buat Purchase Order</h2>
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

 <section class="liquid-glass rounded-xl shadow-sm border border-gray-100 p-6 md:p-8" x-data="poForm()">
 <form action="{{ route('purchase-orders.store') }}" method="POST" class="space-y-8">
 @csrf
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 @if($userLogin->role === 'owner')
 <div class="space-y-2">
 <label for="branch_id" class="block font-label-md text-gray-700">Cabang <span class="text-red-500">*</span></label>
 <x-select id="branch_id" name="branch_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Pilih Cabang</option>
 @foreach($branches as $branch)
 <option value="{{ $branch->id }}">{{ $branch->name }}</option>
 @endforeach
 </x-select>
 </div>
 @else
 <input type="hidden" name="branch_id" value="{{ $userLogin->branch_id }}">
 @endif

 <div class="space-y-2">
 <label for="supplier_id" class="block font-label-md text-gray-700">Supplier <span class="text-red-500">*</span></label>
 <x-select id="supplier_id" name="supplier_id" required class="w-full px-4 py-2.5 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Pilih Supplier</option>
 @foreach($suppliers as $supplier)
 <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
 @endforeach
 </x-select>
 </div>

 <div class="space-y-2">
 <label for="expected_at" class="block font-label-md text-gray-700">Tanggal Estimasi Kedatangan</label>
 <input type="date" id="expected_at" name="expected_at" value="{{ old('expected_at') }}" 
 class="w-full px-4 py-2.5 rounded-full font-body-md text-on-surface-variant outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm cursor-pointer" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 </div>

 <div class="space-y-2">
 <label for="notes" class="block font-label-md text-gray-700">Catatan Khusus</label>
 <textarea id="notes" name="notes" rows="1" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-gray-50/50">{{ old('notes') }}</textarea>
 </div>
 </div>

 <!-- Bagian Items Produk -->
 <div class="border-t border-gray-200 pt-6">
 <h3 class="font-title-md text-on-surface mb-4">Daftar Barang (Item)</h3>
 
 <div class="space-y-4">
 <template x-for="(item, index) in items" :key="index">
 <div class="flex flex-col md:flex-row gap-4 items-end bg-gray-50/50 p-4 rounded-lg border border-gray-100 relative">
 
 <div class="w-full md:w-1/2 space-y-2">
 <label class="block font-label-md text-gray-700">Pilih Produk</label>
 <x-select x-bind:name="`items[${index}][product_id]`" x-model="item.product_id" required 
 class="w-full px-4 py-2 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Pilih Produk...</option>
 @foreach($products as $product)
 <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku }})</option>
 @endforeach
 </x-select>
 </div>

 <div class="w-full md:w-1/4 space-y-2">
 <label class="block font-label-md text-gray-700">Kuantitas (Qty)</label>
 <input type="number" x-bind:name="`items[${index}][quantity_ordered]`" x-model="item.quantity" min="1" required 
 class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary font-body-md bg-white text-right">
 </div>

 <div class="w-full md:w-1/4 space-y-2">
 <label class="block font-label-md text-gray-700">Harga Beli / Unit (Rp)</label>
 <input type="number" x-bind:name="`items[${index}][unit_cost]`" x-model="item.cost" min="0" required 
 class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary font-body-md bg-white text-right">
 </div>

 <button type="button" @click="removeItem(index)" class="absolute top-2 right-2 text-red-500 hover:text-red-700" x-show="items.length > 1">
 <span class="material-symbols-outlined text-[20px]">close</span>
 </button>

 </div>
 </template>
 </div>
 
 <button type="button" @click="addItem()" class="mt-4 px-4 py-2 border-2 border-dashed border-primary text-primary rounded-lg font-label-md hover:bg-blue-50 transition-colors w-full flex items-center justify-center space-x-2">
 <span class="material-symbols-outlined">add</span>
 <span>Tambah Baris Produk</span>
 </button>
 </div>

 <div class="pt-6 border-t border-gray-200 flex justify-end gap-3">
 <a href="{{ route('purchase-orders.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all">Proses Purchase Order</button>
 </div>
 </form>
 </section>

 <script>
 function poForm() {
 return {
 items: [
 { product_id: '', quantity: 1, cost: 0 }
 ],
 addItem() {
 this.items.push({ product_id: '', quantity: 1, cost: 0 });
 },
 removeItem(index) {
 if (this.items.length > 1) {
 this.items.splice(index, 1);
 }
 }
 }
 }
 </script>
</x-layouts.admin>
