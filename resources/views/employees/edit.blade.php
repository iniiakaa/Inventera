@php 
    $role = Auth::user()->role ?? ''; 
@endphp

<x-layouts.admin active="employees" title="Edit Karyawan - Inventera">
    <header class="mb-12 mt-8 md:mt-0">
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen SDM</p>
        <h2 class="font-display text-display text-on-surface">Edit Karyawan</h2>
    </header>

    <section class="max-w-2xl bg-white p-8 rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Input Nama --}}
            <div>
                <label for="name" class="block font-label-md text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
                @error('name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Email --}}
            <div>
                <label for="email" class="block font-label-md text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input No Telepon --}}
            <div>
                <label for="phone" class="block font-label-md text-gray-700 mb-2">No. Telepon (Opsional)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md">
                @error('phone')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Role --}}
            <div>
                <label for="role" class="block font-label-md text-gray-700 mb-2">Role / Jabatan</label>
                <select name="role" id="role" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md capitalize" required>
                    @foreach(['owner', 'manager', 'supervisor', 'warehouse', 'cashier'] as $roleOption)
                        <option value="{{ $roleOption }}" {{ old('role', $employee->role) == $roleOption ? 'selected' : '' }}>
                            {{ $roleOption }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Cabang --}}
            <div>
                <label for="branch_id" class="block font-label-md text-gray-700 mb-2">Penempatan Cabang</label>
                <select name="branch_id" id="branch_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md">
                    <option value="">Tidak Ada Cabang (Akses Semua / Owner)</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Status Akun (Dropdown Tambahan) --}}
            <div>
                <label for="is_active" class="block font-label-md text-gray-700 mb-2">Status Akun</label>
                <select name="is_active" id="is_active" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" required>
                    <option value="1" {{ old('is_active', $employee->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $employee->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('is_active')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password Baru --}}
            <div>
                <label for="password" class="block font-label-md text-gray-700 mb-2">Password Baru (Kosongkan jika tidak ingin diganti)</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md" placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center space-x-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-md hover:opacity-90 transition-all flex items-center space-x-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Perubahan</span>
                </button>
                <a href="{{ route('employees') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full font-label-md text-label-md hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </section>
    <div class="pb-12"></div>
</x-layouts.admin>