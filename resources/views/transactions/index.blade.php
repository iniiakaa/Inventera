<x-layouts.admin active="transactions" title="Transaksi - Inventera">
 <!-- Header -->
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Rekap Penjualan</p>
 <h2 class="font-display text-display text-on-surface">Transaksi</h2>
 </div>
 </header>

 <!-- Summary Cards -->
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
 <div class="liquid-glass rounded-xl p-6 flex items-center gap-4">
 <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
 <span class="material-symbols-outlined text-[24px]" style="font-variation-settings:'FILL' 1;">payments</span>
 </div>
 <div>
 <p class="font-body-sm text-body-sm text-on-surface-variant mb-0.5">Total Pendapatan (Bulan Ini)</p>
 <p class="font-headline-md text-headline-md font-bold text-on-surface">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
 </div>
 </div>
 <div class="liquid-glass rounded-xl p-6 flex items-center gap-4">
 <div class="w-12 h-12 rounded-full bg-secondary/10 text-secondary flex items-center justify-center flex-shrink-0">
 <span class="material-symbols-outlined text-[24px]" style="font-variation-settings:'FILL' 1;">receipt_long</span>
 </div>
 <div>
 <p class="font-body-sm text-body-sm text-on-surface-variant mb-0.5">Jumlah Transaksi (Bulan Ini)</p>
 <p class="font-headline-md text-headline-md font-bold text-on-surface">{{ number_format($totalTrx, 0, ',', '.') }}</p>
 </div>
 </div>
 <div class="liquid-glass rounded-xl p-6 flex items-center gap-4">
 <div class="w-12 h-12 rounded-full bg-tertiary/10 text-tertiary flex items-center justify-center flex-shrink-0">
 <span class="material-symbols-outlined text-[24px]" style="font-variation-settings:'FILL' 1;">trending_up</span>
 </div>
 <div>
 <p class="font-body-sm text-body-sm text-on-surface-variant mb-0.5">Rata-rata per Transaksi</p>
 <p class="font-headline-md text-headline-md font-bold text-on-surface">Rp {{ number_format($avgTrx, 0, ',', '.') }}</p>
 </div>
 </div>
 </div>

 <!-- Filter Bar -->
 <form action="{{ route('transactions') }}" method="GET" class="flex flex-wrap gap-3 mb-6 items-center">
 
 @if($user->role === 'owner' && $branches->count())
 <x-select wrapperClass="w-auto" name="branch_id" class="px-4 py-2.5 border border-gray-200 font-body-md text-gray-700 min-w-[180px] rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Semua Cabang</option>
 @foreach($branches as $branch)
 <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
 @endforeach
 </x-select>
 @endif

 <x-select wrapperClass="w-auto" name="status" class="px-4 py-2.5 border border-gray-200 font-body-md text-gray-700 rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Semua Status</option>
 <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
 <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
 <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
 <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refund</option>
 </x-select>

 <x-select wrapperClass="w-auto" name="payment_method" class="px-4 py-2.5 border border-gray-200 font-body-md text-gray-700 rounded-full outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <option value="">Semua Metode</option>
 <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Tunai</option>
 <option value="debit" {{ request('payment_method') === 'debit' ? 'selected' : '' }}>Debit</option>
 <option value="credit" {{ request('payment_method') === 'credit' ? 'selected' : '' }}>Kredit</option>
 <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
 <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>Transfer</option>
 </x-select>

 <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Tanggal Awal"
 class="px-4 py-2.5 rounded-full font-body-md text-on-surface-variant outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm cursor-pointer" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
 <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="Tanggal Akhir"
 class="px-4 py-2.5 rounded-full font-body-md text-on-surface-variant outline-none focus:ring-2 focus:ring-primary/40 focus:border-transparent transition-all shadow-sm cursor-pointer" style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">

 <button type="submit" class="px-5 py-2.5 bg-gray-800 text-white rounded-xl font-label-md hover:bg-gray-700 transition-colors">Filter</button>

 @if(request()->anyFilled(['branch_id','status','payment_method','date_from','date_to']))
 <a href="{{ route('transactions') }}" class="px-5 py-2.5 bg-red-50 text-red-600 border border-red-200 rounded-xl font-label-md hover:bg-red-100 transition-colors">Reset</a>
 @endif
 </form>

 <!-- Transaction Table -->
 <section class="liquid-glass rounded-xl overflow-hidden">
 <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
 <h3 class="font-headline-md text-headline-md text-on-surface">Riwayat Transaksi</h3>
 <p class="font-label-sm text-label-sm text-on-surface-variant">{{ $transactions->total() }} transaksi ditemukan</p>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="bg-gray-50/60 border-b border-gray-100">
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider">No. Invoice</th>
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider">Kasir</th>
 @if($user->role === 'owner')
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider">Cabang</th>
 @endif
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider text-center">Metode</th>
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider text-right">Total</th>
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider text-center">Status</th>
 <th class="px-6 py-4 font-label-sm text-gray-500 uppercase tracking-wider text-right">Waktu</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-50 font-body-md text-gray-800">
 @forelse($transactions as $trx)
 <tr class="hover:bg-gray-50/60 transition-colors">
 <td class="px-6 py-4">
 <p class="font-medium text-primary">{{ $trx->invoice_number }}</p>
 <p class="text-xs text-gray-400 mt-0.5">{{ $trx->items->count() }} item</p>
 </td>
 <td class="px-6 py-4 text-gray-600">{{ $trx->user->name ?? '-' }}</td>
 @if($user->role === 'owner')
 <td class="px-6 py-4 text-gray-600">{{ $trx->branch->name ?? '-' }}</td>
 @endif
 <td class="px-6 py-4 text-center">
 @php
 $methods = ['cash'=>'Tunai','debit'=>'Debit','credit'=>'Kredit','qris'=>'QRIS','transfer'=>'Transfer'];
 $methodIcons = ['cash'=>'payments','debit'=>'credit_card','credit'=>'credit_score','qris'=>'qr_code_scanner','transfer'=>'account_balance'];
 @endphp
 <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 text-gray-700 font-label-sm text-[11px]">
 <span class="material-symbols-outlined text-[13px]">{{ $methodIcons[$trx->payment_method] ?? 'payments' }}</span>
 {{ $methods[$trx->payment_method] ?? $trx->payment_method }}
 </span>
 </td>
 <td class="px-6 py-4 text-right font-medium">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
 <td class="px-6 py-4 text-center">
 @php
 $statusMap = [
 'completed' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-700'],
 'pending' => ['label' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-700'],
 'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-600'],
 'refunded' => ['label' => 'Refund', 'class' => 'bg-orange-100 text-orange-700'],
 ];
 $st = $statusMap[$trx->status] ?? ['label' => $trx->status, 'class' => 'bg-gray-100 text-gray-700'];
 @endphp
 <span class="px-2.5 py-1 rounded-full font-label-sm text-[11px] {{ $st['class'] }}">{{ $st['label'] }}</span>
 </td>
 <td class="px-6 py-4 text-right text-gray-500 text-sm">
 {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}<br>
 <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($trx->created_at)->format('H:i') }}</span>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="{{ $user->role === 'owner' ? 7 : 6 }}" class="px-6 py-16 text-center text-gray-400 font-body-md">
 Belum ada transaksi yang sesuai filter.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>

 @if($transactions->hasPages())
 <div class="px-6 py-4 border-t border-gray-100">
 {{ $transactions->links() }}
 </div>
 @endif
 </section>
 <div class="pb-12"></div>
</x-layouts.admin>