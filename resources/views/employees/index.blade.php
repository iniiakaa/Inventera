@php 
    $userLogin = Auth::user();
    $roleLogin = $userLogin->role ?? ''; 
@endphp

<x-layouts.admin active="employees" title="Karyawan - Inventera">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
        <div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen SDM</p>
            <h2 class="font-display text-display text-on-surface">Karyawan</h2>
        </div>
        
        {{-- HANYA BUKAN OWNER YANG BISA TAMBAH --}}
        @if($roleLogin !== 'owner')
            <a href="{{ route('employees.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                <span>Tambah Karyawan</span>
            </a>
        @endif
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

    <section class="liquid-glass rounded-xl overflow-hidden bg-white shadow-sm border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50/50">
                        <th class="p-4 font-label-md text-gray-600">Nama</th>
                        <th class="p-4 font-label-md text-gray-600">Email</th>
                        <th class="p-4 font-label-md text-gray-600">Role</th>
                        <th class="p-4 font-label-md text-gray-600">Cabang</th>
                        <th class="p-4 font-label-md text-gray-600">Status</th>
                        {{-- HANYA TAMPILKAN KOLOM AKSI JIKA BUKAN OWNER --}}
                        @if($roleLogin !== 'owner')
                            <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
                    @forelse($employees as $employee)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 font-medium">{{ $employee->name }}</td>
                            <td class="p-4 text-gray-500">{{ $employee->email }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 capitalize">
                                    {{ $employee->role }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-600">{{ $employee->branch->name ?? 'Tidak Ada Cabang' }}</td>
                            
                            <td class="p-4">
                                @if($employee->is_active)
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Aktif</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">Nonaktif</span>
                                @endif
                            </td>

                            {{-- HANYA TAMPILKAN AKSI JIKA BUKAN OWNER --}}
                            @if($roleLogin !== 'owner')
                                <td class="p-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        @if($roleLogin === 'manager' && in_array($employee->role, ['owner', 'manager', 'supervisor']))
                                            <span class="text-gray-400 text-xs italic">Dinkunci oleh Sistem</span>
                                        @else
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="text-primary hover:text-opacity-80 p-1 flex items-center" title="Edit">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </a>
                                            
                                            <form action="{{ route('employees.toggle-status', $employee->id) }}" method="POST" onsubmit="return confirm('Ubah status aktif karyawan?')" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="{{ $employee->is_active ? 'text-yellow-600' : 'text-green-600' }} hover:text-opacity-80 p-1 flex items-center">
                                                    <span class="material-symbols-outlined text-[20px]">{{ $employee->is_active ? 'block' : 'check_circle' }}</span>
                                                </button>
                                            </form>

                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Hapus permanen karyawan ini?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-opacity-80 p-1 flex items-center">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $roleLogin === 'owner' ? 5 : 6 }}" class="p-12 text-center text-gray-400 font-body-md">
                                Belum ada data karyawan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.admin>