@php 
 $userLogin = Auth::user();
 $roleLogin = $userLogin->role ?? ''; 
@endphp

<x-layouts.admin active="inventory" title="Stock Opname - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen Inventori</p>
 <h2 class="font-display text-display text-on-surface">Stock Opname (Penyesuaian Fisik)</h2>
 </div>
 
 @if(in_array($roleLogin, ['owner', 'manager', 'warehouse']))
 <a href="{{ route('stock-opnames.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">inventory</span>
 <span>Ajukan Penyesuaian</span>
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

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Tanggal Pengajuan</th>
 <th class="p-4 font-label-md text-gray-600">Produk</th>
 <th class="p-4 font-label-md text-gray-600">Cabang</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Selisih</th>
 <th class="p-4 font-label-md text-gray-600">Status</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($stockOpnames as $opname)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($opname->created_at)->format('d/m/Y H:i') }}</td>
 <td class="p-4">
 <p class="font-medium">{{ $opname->product->name ?? '-' }}</p>
 <p class="text-xs text-gray-500">Oleh: {{ $opname->user->name ?? '-' }}</p>
 </td>
 <td class="p-4 text-gray-600">{{ $opname->branch->name ?? '-' }}</td>
 <td class="p-4 text-center">
 @if($opname->difference > 0)
 <span class="text-green-600 font-medium">+{{ $opname->difference }}</span>
 @else
 <span class="text-red-600 font-medium">{{ $opname->difference }}</span>
 @endif
 </td>
 <td class="p-4">
 @if($opname->status === 'approved')
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Disetujui</span>
 @elseif($opname->status === 'rejected')
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">Ditolak</span>
 @else
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-50 text-yellow-700">Menunggu (Pending)</span>
 @endif
 </td>
 <td class="p-4 text-center">
 <a href="{{ route('stock-opnames.edit', $opname->id) }}" class="text-primary hover:text-opacity-80 p-1 font-label-md inline-block">
 Detail / Proses
 </a>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada riwayat pengajuan Stock Opname.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </section>
</x-layouts.admin>
