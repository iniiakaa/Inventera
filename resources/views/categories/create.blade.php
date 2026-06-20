<x-layouts.admin active="categories" title="Tambah Kategori - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Master Data</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Tambah Kategori</h2>
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
 <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
 @csrf
 
 <div class="space-y-2">
 <label for="name" class="block font-label-md text-gray-700">Nama Kategori <span class="text-red-500">*</span></label>
 <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Minuman, Makanan Ringan"
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="description" class="block font-label-md text-gray-700">Deskripsi Kategori</label>
 <textarea id="description" name="description" rows="3" placeholder="Opsional"
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">{{ old('description') }}</textarea>
 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('categories.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all">Simpan Kategori</button>
 </div>
 </form>
 </section>
</x-layouts.admin>
