@php 
 $userLogin = Auth::user();
 $roleLogin = $userLogin->role ?? ''; 
@endphp

<x-layouts.admin active="inventory" title="Purchase Orders - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Manajemen Inventori</p>
 <h2 class="font-display text-display text-on-surface">Purchase Orders (Inbound)</h2>
 </div>
 
 @if(in_array($roleLogin, ['owner', 'manager', 'warehouse']))
 <a href="{{ route('purchase-orders.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
 <span>Buat PO Baru</span>
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
 <th class="p-4 font-label-md text-gray-600">Nomor PO</th>
 <th class="p-4 font-label-md text-gray-600">Supplier</th>
 <th class="p-4 font-label-md text-gray-600">Cabang</th>
 <th class="p-4 font-label-md text-gray-600">Tanggal Order</th>
 <th class="p-4 font-label-md text-gray-600">Total Rp</th>
 <th class="p-4 font-label-md text-gray-600">Status</th>
 <th class="p-4 font-label-md text-gray-600 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($purchaseOrders as $po)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4 font-medium text-primary">{{ $po->po_number }}</td>
 <td class="p-4">{{ $po->supplier->name ?? '-' }}</td>
 <td class="p-4 text-gray-600">{{ $po->branch->name ?? '-' }}</td>
 <td class="p-4 text-gray-500">{{ \Carbon\Carbon::parse($po->ordered_at)->format('d M Y') }}</td>
 <td class="p-4 font-medium">Rp {{ number_format($po->total_amount, 0, ',', '.') }}</td>
 <td class="p-4">
 @if($po->status === 'received')
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Received</span>
 @elseif($po->status === 'cancelled')
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">Cancelled</span>
 @elseif($po->status === 'sent')
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700">Sent</span>
 @else
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 capitalize">{{ $po->status }}</span>
 @endif
 </td>
 <td class="p-4 text-center">
 <a href="{{ route('purchase-orders.edit', $po->id) }}" class="text-primary hover:text-opacity-80 p-1 font-label-md inline-block">
 Lihat / Ubah Status
 </a>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="7" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada riwayat Purchase Order.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </section>
</x-layouts.admin>
