<x-layouts.admin active="inventory" title="Inventaris - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Gudang & Stok</p>
 <h2 class="font-display text-display text-on-surface">Data Inventaris</h2>
 </div>
 
 <div class="flex gap-3 items-center">
 <a href="{{ route('inventory.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">add_box</span>
 <span>Barang Masuk</span>
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

 @if($user->role === 'owner' || $user->role === 'manager')
 <!-- Filter -->
 <div class="mb-6 flex">
 <form action="{{ route('inventory.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
 <x-select wrapperClass="w-auto" name="branch_id" class="px-4 py-2 border border-gray-300 font-body-md rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Semua Cabang</option>
 @foreach($branches as $branch)
 <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
 @endforeach
 </x-select>
 <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 font-label-md transition-colors">Filter</button>
 @if(request('branch_id'))
 <a href="{{ route('inventory.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 font-label-md transition-colors flex items-center">Reset</a>
 @endif
 </form>
 </div>
 @endif

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Produk</th>
 <th class="p-4 font-label-md text-gray-600">Cabang</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Stok Sistem</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Batas Minimum</th>
 <th class="p-4 font-label-md text-gray-600">Terakhir Masuk</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($inventories as $inv)
 <tr class="hover:bg-gray-50/50 transition-colors {{ $inv->stock <= $inv->min_stock ? 'bg-red-50/30' : '' }}">
 <td class="p-4">
 <p class="font-medium">{{ $inv->product->name ?? '-' }}</p>
 <p class="text-xs text-gray-500">SKU: {{ $inv->product->sku ?? '-' }}</p>
 </td>
 <td class="p-4 text-gray-600">{{ $inv->branch->name ?? '-' }}</td>
 <td class="p-4 text-center">
 <span class="font-bold {{ $inv->stock <= $inv->min_stock ? 'text-red-600' : 'text-gray-800' }}">{{ $inv->stock }}</span> {{ $inv->product->unit ?? '' }}
 @if($inv->stock <= $inv->min_stock)
 <div class="text-[11px] text-red-500 font-medium mt-1">Stok Kritis</div>
 @endif
 </td>
 <td class="p-4 text-center text-gray-600">{{ $inv->min_stock }}</td>
 <td class="p-4 text-gray-600">{{ $inv->last_restocked_at ? \Carbon\Carbon::parse($inv->last_restocked_at)->format('d M Y') : '-' }}</td>
 <td class="p-4 text-center">
 <div class="flex items-center justify-center space-x-3">
 <a href="{{ route('inventory.edit', $inv->id) }}" class="text-primary hover:text-opacity-80 p-1" title="Penyesuaian Manual">
 <span class="material-symbols-outlined text-[20px]">edit</span>
 </a>
 <form action="{{ route('inventory.destroy', $inv->id) }}" method="POST" onsubmit="return confirm('Hapus data inventaris ini secara permanen?')" class="inline">
 @csrf @method('DELETE')
 <button type="submit" class="text-red-600 hover:text-opacity-80 p-1" title="Hapus Data">
 <span class="material-symbols-outlined text-[20px]">delete</span>
 </button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada data inventaris. Tambahkan barang masuk terlebih dahulu.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 
 @if($inventories->hasPages())
 <div class="p-4 border-t border-gray-100">
 {{ $inventories->withQueryString()->links() }}
 </div>
 @endif
 </section>
</x-layouts.admin>
