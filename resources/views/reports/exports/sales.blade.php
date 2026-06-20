<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Laporan Penjualan</title>
 <style>
 body { font-family: sans-serif; font-size: 12px; }
 .header { text-align: center; margin-bottom: 20px; }
 .header h2 { margin: 0; padding: 0; }
 .header p { margin: 5px 0; color: #555; }
 table { width: 100%; border-collapse: collapse; margin-top: 10px; }
 th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
 th { background-color: #f4f4f4; }
 .text-right { text-align: right; }
 .text-center { text-align: center; }
 .font-bold { font-weight: bold; }
 </style>
</head>
<body>
 <div class="header">
 <h2>Laporan Penjualan Inventera</h2>
 <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
 </div>

 <table>
 <thead>
 <tr>
 <th class="text-center">No</th>
 <th>No Invoice</th>
 <th>Tanggal</th>
 <th>Kasir</th>
 <th>Cabang</th>
 <th class="text-right">Subtotal</th>
 <th class="text-right">Diskon</th>
 <th class="text-right">Total</th>
 </tr>
 </thead>
 <tbody>
 @php $grandTotal = 0; @endphp
 @forelse($transactions as $index => $trx)
 @php $grandTotal += $trx->total_amount; @endphp
 <tr>
 <td class="text-center">{{ $index + 1 }}</td>
 <td>{{ $trx->invoice_number }}</td>
 <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
 <td>{{ $trx->user->name ?? '-' }}</td>
 <td>{{ $trx->branch->name ?? '-' }}</td>
 <td class="text-right">Rp {{ number_format($trx->subtotal, 0, ',', '.') }}</td>
 <td class="text-right">Rp {{ number_format($trx->discount, 0, ',', '.') }}</td>
 <td class="text-right font-bold">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="8" class="text-center">Tidak ada transaksi pada periode ini.</td>
 </tr>
 @endforelse
 </tbody>
 <tfoot>
 <tr>
 <td colspan="7" class="text-right font-bold">Total Penjualan Keseluruhan:</td>
 <td class="text-right font-bold" style="background-color: #e6f7ff;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
 </tr>
 </tfoot>
 </table>
</body>
</html>
