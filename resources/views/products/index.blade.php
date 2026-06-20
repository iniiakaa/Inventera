<x-layouts.admin active="products" title="Master Produk - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Master Data</p>
 <h2 class="font-display text-display text-on-surface">Data Produk</h2>
 </div>
 
 <div class="flex gap-3 items-center">
 <a href="{{ route('categories.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-full font-label-md transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">category</span>
 <span>Kelola Kategori</span>
 </a>
 <a href="{{ route('products.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">add_box</span>
 <span>Tambah Produk</span>
 </a>
 </div>
 </header>

 @if(session('success'))
 <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg font-body-md">
 {{ session('success') }}
 </div>
 @endif
 @if(session('error'))
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 {{ session('error') }}
 </div>
 @endif

 <!-- Filter -->
 <div class="mb-6 flex relative" id="category-filter-wrapper">
 <form action="{{ route('products.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
 
 <input type="hidden" name="category" id="category-input" value="{{ request('category') }}">
 
 @php
 $selectedCat = $categories->firstWhere('id', request('category'));
 $selectedName = $selectedCat ? $selectedCat->name : 'Semua Kategori';
 @endphp

 <!-- Dropdown Button -->
 <button type="button" id="category-filter-btn" onclick="toggleCategoryFilter()"
 class="relative h-11 px-4 flex items-center justify-between rounded-xl text-on-surface transition-all duration-200 min-w-[200px]"
 style="background: rgba(255,255,255,0.25); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <span id="category-filter-label" class="font-body-md truncate mr-2">{{ $selectedName }}</span>
 <span class="material-symbols-outlined text-[20px] text-on-surface-variant transition-transform duration-200" id="category-filter-icon">expand_more</span>
 </button>

 <!-- Dropdown Panel (styled like notif-dropdown) -->
 <div id="category-filter-dropdown" class="category-dropdown absolute left-0 mt-14 w-[280px] z-50 origin-top-left rounded-[24px]"
 aria-hidden="true">
 
 <ul class="divide-y max-h-[300px] overflow-y-auto py-2" style="divide-color: rgba(255,255,255,0.3);">
 <li class="notif-item flex items-center px-5 py-3 relative cursor-pointer" onclick="selectCategory('', 'Semua Kategori')">
 <span class="font-body-md text-on-surface {{ !request('category') ? 'font-bold text-primary' : '' }}">Semua Kategori</span>
 </li>
 
 @foreach($categories as $cat)
 <li class="notif-item flex items-center justify-between px-5 py-3 relative cursor-pointer group" onclick="selectCategory('{{ $cat->id }}', '{{ addslashes($cat->name) }}')">
 <span class="font-body-md text-on-surface {{ request('category') == $cat->id ? 'font-bold text-primary' : '' }}">{{ $cat->name }}</span>
 <!-- CRUD Actions (edit/delete category directly from dropdown) -->
 <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
 <a href="{{ route('categories.edit', $cat->id) }}" onclick="event.stopPropagation()" class="text-primary hover:text-opacity-80 p-1 rounded-full hover:bg-white/50" title="Edit Kategori">
 <span class="material-symbols-outlined text-[16px]">edit</span>
 </a>
 </div>
 </li>
 @endforeach
 </ul>

 <!-- Footer (Tambah Kategori) -->
 <div class="px-5 py-3.5" style="border-top: 1px solid rgba(255,255,255,0.3);">
 <a href="{{ route('categories.create') }}"
 class="flex items-center justify-center gap-1.5 font-label-md text-label-md text-primary hover:opacity-70 transition-opacity">
 <span class="material-symbols-outlined text-[18px]">add</span>
 <span>Tambah Kategori Baru</span>
 </a>
 </div>
 </div>

 <button type="submit" class="px-5 py-2.5 bg-gray-800 text-white rounded-xl hover:bg-gray-700 font-label-md transition-colors shadow-sm">Filter</button>
 
 @if(request('category'))
 <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 font-label-md transition-colors flex items-center border border-red-200">Reset</a>
 @endif
 </form>
 </div>

 <style>
 #category-filter-dropdown {
 background: rgba(235, 240, 255, 0.38);
 backdrop-filter: blur(12px) saturate(1.8) brightness(1.06) contrast(0.96);
 -webkit-backdrop-filter: blur(12px) saturate(1.8) brightness(1.06) contrast(0.96);
 border: 1px solid rgba(255, 255, 255, 0.72);
 box-shadow: 0 8px 32px rgba(0, 0, 0, 0.07), 0 40px 80px rgba(0, 0, 0, 0.09), inset 0 1.5px 0 rgba(255, 255, 255, 0.92);
 overflow: clip;
 }

 #category-filter-dropdown::before {
 content: '';
 position: absolute;
 inset: 0;
 border-radius: inherit;
 background: linear-gradient(140deg, rgba(255, 255, 255, 0.42) 0%, rgba(255, 255, 255, 0.04) 45%, rgba(180, 200, 255, 0.06) 75%, rgba(255, 255, 255, 0.22) 100%);
 pointer-events: none;
 z-index: 0;
 }

 #category-filter-dropdown > * {
 position: relative;
 z-index: 1;
 }

 .category-dropdown {
 pointer-events: none;
 opacity: 0;
 transform: scale(0.92) translateY(-8px);
 transform-origin: top left;
 transition: opacity 0.28s cubic-bezier(0.32, 0.72, 0, 1), transform 0.28s cubic-bezier(0.32, 0.72, 0, 1);
 }

 .category-dropdown.open {
 pointer-events: auto;
 opacity: 1;
 transform: scale(1) translateY(0);
 }

 .notif-item {
 transition: background 0.18s ease;
 }

 .notif-item:hover {
 background: rgba(255, 255, 255, 0.4);
 }

 #category-filter-dropdown ::-webkit-scrollbar { width: 4px; }
 #category-filter-dropdown ::-webkit-scrollbar-track { background: transparent; }
 #category-filter-dropdown ::-webkit-scrollbar-thumb { background: rgba(0, 88, 188, 0.2); border-radius: 9999px; }
 </style>

 <script>
 function toggleCategoryFilter() {
 const dropdown = document.getElementById('category-filter-dropdown');
 const icon = document.getElementById('category-filter-icon');
 if (dropdown.classList.contains('open')) {
 dropdown.classList.remove('open');
 dropdown.setAttribute('aria-hidden', 'true');
 icon.style.transform = 'rotate(0deg)';
 } else {
 dropdown.classList.add('open');
 dropdown.setAttribute('aria-hidden', 'false');
 icon.style.transform = 'rotate(180deg)';
 }
 }

 function selectCategory(id, name) {
 document.getElementById('category-input').value = id;
 document.getElementById('category-filter-label').innerText = name;
 // Optionally auto-submit:
 // document.getElementById('category-input').closest('form').submit();
 toggleCategoryFilter();
 }

 document.addEventListener('click', function (e) {
 const wrapper = document.getElementById('category-filter-wrapper');
 if (wrapper && !wrapper.contains(e.target)) {
 const dropdown = document.getElementById('category-filter-dropdown');
 const icon = document.getElementById('category-filter-icon');
 if (dropdown && dropdown.classList.contains('open')) {
 dropdown.classList.remove('open');
 dropdown.setAttribute('aria-hidden', 'true');
 icon.style.transform = 'rotate(0deg)';
 }
 }
 });
 </script>

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Produk</th>
 <th class="p-4 font-label-md text-gray-600">Kategori</th>
 <th class="p-4 font-label-md text-gray-600">Harga Beli</th>
 <th class="p-4 font-label-md text-gray-600">Harga Jual</th>
 <th class="p-4 font-label-md text-gray-600">Satuan</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Status</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($products as $product)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4">
 <p class="font-medium">{{ $product->name }}</p>
 <p class="text-xs text-gray-500">SKU: {{ $product->sku }} {{ $product->barcode ? '| Barcode: '.$product->barcode : '' }}</p>
 </td>
 <td class="p-4 text-gray-600">{{ $product->category->name ?? '-' }}</td>
 <td class="p-4 text-gray-600">Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
 <td class="p-4 font-medium text-primary">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
 <td class="p-4 text-gray-600">{{ $product->unit }}</td>
 <td class="p-4 text-center">
 @if($product->is_active)
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Aktif</span>
 @else
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">Nonaktif</span>
 @endif
 </td>
 <td class="p-4 text-center">
 <div class="flex items-center justify-center space-x-3">
 <a href="{{ route('products.edit', $product->id) }}" class="text-primary hover:text-opacity-80 p-1">
 <span class="material-symbols-outlined text-[20px]">edit</span>
 </a>
 <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" class="inline">
 @csrf @method('DELETE')
 <button type="submit" class="text-red-600 hover:text-opacity-80 p-1">
 <span class="material-symbols-outlined text-[20px]">delete</span>
 </button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="7" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada data produk.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 
 @if($products->hasPages())
 <div class="p-4 border-t border-gray-100">
 {{ $products->withQueryString()->links() }}
 </div>
 @endif
 </section>
</x-layouts.admin>
