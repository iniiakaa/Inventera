<x-layouts.admin active="employees" title="Tambah Karyawan Baru - Inventera">
 <header class="flex items-center justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen SDM</p>
 <h2 class="font-display text-display text-on-surface">Tambah Karyawan Baru</h2>
 </div>
 <a href="{{ route('employees') }}" class="px-4 py-2 border border-gray-300 rounded-full font-label-md text-label-md text-gray-700 hover:bg-gray-50 transition-all flex items-center space-x-1.5 w-fit">
 <span class="material-symbols-outlined text-[18px]">arrow_back</span>
 <span>Kembali</span>
 </a>
 </header>

 @if ($errors->any())
 <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg font-body-md">
 <p class="font-semibold mb-1">Terjadi kesalahan input:</p>
 <ul class="list-disc pl-5 text-sm">
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif

 <section class="max-w-2xl bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
 <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
 @csrf

 {{-- Input Nama Lengkap --}}
 <div>
 <label for="name" class="block font-label-md text-gray-700 mb-2">Nama Lengkap</label>
 <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama karyawan" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
 </div>

 {{-- Input Alamat Email --}}
 <div>
 <label for="email" class="block font-label-md text-gray-700 mb-2">Alamat Email</label>
 <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh: nama@jayusman.id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
 </div>

 {{-- Input Password --}}
 <div>
 <label for="password" class="block font-label-md text-gray-700 mb-2">Password Akun</label>
 <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
 </div>

 {{-- Input Nomor Telepon --}}
 <div>
 <label for="phone" class="block font-label-md text-gray-700 mb-2">Nomor Telepon</label>
 <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md">
 </div>

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 {{-- Dropdown Pilihan Role Dinamis --}}
 <div>
 <label for="role" class="block font-label-md text-gray-700 mb-2">Role / Jabatan</label>
 <x-select name="role" id="role" class="w-full px-4 py-2.5 border border-gray-300 transition-all font-body-md capitalize rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);" required>
 <option value="">-- Pilih Role --</option>
 @foreach($roles as $roleOption)
 <option value="{{ $roleOption }}" {{ old('role') == $roleOption ? 'selected' : '' }}>
 {{ $roleOption }}
 </option>
 @endforeach
 </x-select>
 </div>

 {{-- Dropdown Penempatan Cabang --}}
 <div>
 <label for="branch_id" class="block font-label-md text-gray-700 mb-2">Penempatan Cabang</label>
 <x-select name="branch_id" id="branch_id" class="w-full px-4 py-2.5 border border-gray-300 transition-all font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Tidak Ada Cabang (Pusat)</option>
 @foreach($branches as $branch)
 <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
 {{ $branch->name }}
 </option>
 @endforeach
 </x-select>
 </div>
 </div>

 {{-- Tombol Submit --}}
 <div class="pt-4">
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-md hover:opacity-90 transition-all flex items-center space-x-2">
 <span class="material-symbols-outlined text-[18px]">save</span>
 <span>Simpan Karyawan</span>
 </button>
 </div>
 </form>
 </section>
 <div class="pb-12"></div>
</x-layouts.admin>