<x-layouts.admin active="inventory" title="Edit Supplier - Inventera">
 <header class="mb-8 mt-8 md:mt-0">
 <div class="flex items-center space-x-3 mb-2">
 <a href="{{ route('suppliers.index') }}" class="text-gray-400 hover:text-primary transition-colors">
 <span class="material-symbols-outlined">arrow_back</span>
 </a>
 <p class="font-body-lg text-body-lg text-on-surface-variant">Manajemen Inventori</p>
 </div>
 <h2 class="font-display text-display text-on-surface">Edit Supplier</h2>
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

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
 <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
 @csrf
 @method('PUT')
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <div class="space-y-2">
 <label for="name" class="block font-label-md text-gray-700">Nama Perusahaan / Supplier <span class="text-red-500">*</span></label>
 <input type="text" id="name" name="name" value="{{ old('name', $supplier->name) }}" required 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="contact_person" class="block font-label-md text-gray-700">Nama Kontak (CP)</label>
 <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="phone" class="block font-label-md text-gray-700">Nomor Telepon / WhatsApp</label>
 <input type="text" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="email" class="block font-label-md text-gray-700">Email</label>
 <input type="email" id="email" name="email" value="{{ old('email', $supplier->email) }}" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>
 </div>

 <div class="space-y-2">
 <label for="npwp" class="block font-label-md text-gray-700">NPWP</label>
 <input type="text" id="npwp" name="npwp" value="{{ old('npwp', $supplier->npwp) }}" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">
 </div>

 <div class="space-y-2">
 <label for="address" class="block font-label-md text-gray-700">Alamat Lengkap</label>
 <textarea id="address" name="address" rows="3" 
 class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md bg-gray-50/50">{{ old('address', $supplier->address) }}</textarea>
 </div>

 <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-lg">
 <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $supplier->is_active) ? 'checked' : '' }}
 class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
 <label for="is_active" class="font-label-md text-gray-700 cursor-pointer">Supplier Aktif</label>
 </div>

 <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
 <a href="{{ route('suppliers.index') }}" class="px-6 py-2.5 rounded-full font-label-md text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md shadow-md hover:bg-opacity-90 transition-all">Simpan Perubahan</button>
 </div>
 </form>
 </section>
</x-layouts.admin>
