<x-layouts.admin active="categories" title="Kategori Produk - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Master Data</p>
 <h2 class="font-display text-display text-on-surface">Kategori Produk</h2>
 </div>
 
 <a href="{{ route('categories.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">category</span>
 <span>Tambah Kategori</span>
 </a>
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

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Nama Kategori</th>
 <th class="p-4 font-label-md text-gray-600">Slug</th>
 <th class="p-4 font-label-md text-gray-600">Deskripsi</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($categories as $category)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4 font-medium">{{ $category->name }}</td>
 <td class="p-4 text-gray-500">{{ $category->slug }}</td>
 <td class="p-4 text-gray-600">{{ Str::limit($category->description ?? '-', 50) }}</td>
 <td class="p-4 text-center">
 <div class="flex items-center justify-center space-x-3">
 <a href="{{ route('categories.edit', $category->id) }}" class="text-primary hover:text-opacity-80 p-1">
 <span class="material-symbols-outlined text-[20px]">edit</span>
 </a>
 <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus permanen kategori ini? Pastikan tidak ada produk yang terhubung.')" class="inline">
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
 <td colspan="4" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada data kategori.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </section>
</x-layouts.admin>
