@php 
    $role = Auth::user()->role ?? ''; 
@endphp

<x-layouts.admin active="employees" title="Tambah Karyawan - Inventera">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
        <div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen SDM</p>
            <h2 class="font-display text-display text-on-surface">Tambah Karyawan Baru</h2>
        </div>
        <a href="{{ route('employees') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full font-label-md text-label-md hover:bg-gray-200 transition-all flex items-center space-x-2 w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali</span>
        </a>
    </header>

    <section class="max-w-2xl bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex flex-col space-y-2">
                <label for="name" class="font-label-md text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary @error('name') border-red-500 @enderror" placeholder="Masukkan nama karyawan" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label for="email" class="font-label-md text-gray-700">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary @error('email') border-red-500 @enderror" placeholder="contoh: nama@jayusman.id" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label for="password" class="font-label-md text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary @error('password') border-red-500 @enderror" placeholder="Minimal 8 karakter" required>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col space-y-2">
                    <label for="role" class="font-label-md text-gray-700">Jabatan / Role</label>
                    <select name="role" id="role" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary bg-white" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="warehouse" {{ old('role') == 'warehouse' ? 'selected' : '' }}>Warehouse</option>
                        <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="branch_id" class="font-label-md text-gray-700">Penempatan Cabang</label>
                    <select name="branch_id" id="branch_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary bg-white">
                        <option value="">Tidak Ada Cabang (Pusat)</option>
                        @if(isset($branches))
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('branch_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center justify-center space-x-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Karyawan</span>
                </button>
            </div>
        </form>
    </section>
    <div class="pb-12"></div>
</x-layouts.admin>