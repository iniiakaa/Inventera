<x-layouts.admin active="employees" title="Edit Data Karyawan - Inventera">
 <header class="flex items-center justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen SDM</p>
 <h2 class="font-display text-display text-on-surface">Edit Data Karyawan</h2>
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
 <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-6">
 @csrf
 @method('PUT')

 {{-- Input Nama Lengkap --}}
 <div>
 <label for="name" class="block font-label-md text-gray-700 mb-2">Nama Lengkap</label>
 <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
 </div>

 {{-- Input Alamat Email --}}
 <div>
 <label for="email" class="block font-label-md text-gray-700 mb-2">Alamat Email</label>
 <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
 </div>

 {{-- Input Password (Opsional saat Edit) --}}
 <div>
 <label for="password" class="block font-label-md text-gray-700 mb-2">Password Baru (Opsional)</label>
 <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md">
 </div>

 {{-- Input Nomor Telepon --}}
 <div>
 <label for="phone" class="block font-label-md text-gray-700 mb-2">Nomor Telepon</label>
 <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md">
 </div>

 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
 {{-- Dropdown Pilihan Role Dinamis (Membatasi Opsi Sesuai Login Manajer) --}}
 <div>
 <label for="role" class="block font-label-md text-gray-700 mb-2">Role / Jabatan</label>
 <x-select name="role" id="role" class="w-full px-4 py-2.5 border border-gray-300 transition-all font-body-md capitalize rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);" required>
 @foreach($roles as $roleOption)
 <option value="{{ $roleOption }}" {{ old('role', $employee->role) == $roleOption ? 'selected' : '' }}>
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
 <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>
 {{ $branch->name }}
 </option>
 @endforeach
 </x-select>
 </div>

 {{-- Dropdown Status Keaktifan Akun Karyawan --}}
 <div>
 <label for="is_active" class="block font-label-md text-gray-700 mb-2">Status Akun</label>
 <x-select name="is_active" id="is_active" class="w-full px-4 py-2.5 border border-gray-300 transition-all font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);" required>
 <option value="1" {{ old('is_active', $employee->is_active) == 1 || $employee->is_active == true ? 'selected' : '' }}>Aktif</option>
 <option value="0" {{ old('is_active', $employee->is_active) == 0 || $employee->is_active == false ? 'selected' : '' }}>Nonaktif</option>
 </x-select>
 </div>
 </div>

 {{-- Tombol Submit Pembaruan --}}
 <div class="pt-4">
 <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-md hover:opacity-90 transition-all flex items-center space-x-2">
 <span class="material-symbols-outlined text-[18px]">save</span>
 <span>Perbarui Data</span>
 </button>
 </div>
 </form>
 </section>
 <div class="pb-12"></div>
</x-layouts.admin>