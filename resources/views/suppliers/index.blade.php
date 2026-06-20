@php 
 $userLogin = Auth::user();
 $roleLogin = $userLogin->role ?? ''; 
@endphp

<x-layouts.admin active="inventory" title="Supplier - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen Inventori</p>
 <h2 class="font-display text-display text-on-surface">Supplier</h2>
 </div>
 
 @if(in_array($roleLogin, ['owner', 'manager']))
 <a href="{{ route('suppliers.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">add_business</span>
 <span>Tambah Supplier</span>
 </a>
 @endif
 </header>

 @if(session('success'))
 <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg font-body-md">
 {{ session('success') }}
 </div>
 @endif

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Nama Supplier</th>
 <th class="p-4 font-label-md text-gray-600">Kontak</th>
 <th class="p-4 font-label-md text-gray-600">Telepon</th>
 <th class="p-4 font-label-md text-gray-600">Status</th>
 @if(in_array($roleLogin, ['owner', 'manager']))
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 @endif
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($suppliers as $supplier)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4 font-medium">{{ $supplier->name }}</td>
 <td class="p-4 text-gray-500">{{ $supplier->contact_person ?? '-' }}</td>
 <td class="p-4 text-gray-600">{{ $supplier->phone ?? '-' }}</td>
 <td class="p-4">
 @if($supplier->is_active)
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Aktif</span>
 @else
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">Nonaktif</span>
 @endif
 </td>
 @if(in_array($roleLogin, ['owner', 'manager']))
 <td class="p-4 text-center">
 <div class="flex items-center justify-center space-x-3">
 <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-primary hover:text-opacity-80 p-1">
 <span class="material-symbols-outlined text-[20px]">edit</span>
 </a>
 <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Hapus permanen supplier ini?')" class="inline">
 @csrf @method('DELETE')
 <button type="submit" class="text-red-600 hover:text-opacity-80 p-1">
 <span class="material-symbols-outlined text-[20px]">delete</span>
 </button>
 </form>
 </div>
 </td>
 @endif
 </tr>
 @empty
 <tr>
 <td colspan="{{ in_array($roleLogin, ['owner', 'manager']) ? 5 : 4 }}" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada data supplier.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </section>
</x-layouts.admin>
