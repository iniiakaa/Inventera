<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Laporan Stok</title>
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
 .text-danger { color: red; font-weight: bold; }
 </style>
</head>
<body>
 <div class="header">
 <h2>Laporan Ketersediaan Stok Inventera</h2>
 <p>Cabang: {{ $branchName }}</p>
 <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
 </div>

 <table>
 <thead>
 <tr>
 <th class="text-center">No</th>
 <th>Kode Produk (SKU)</th>
 <th>Nama Produk</th>
 <th>Kategori</th>
 <th>Cabang</th>
 <th class="text-center">Min. Stok</th>
 <th class="text-right">Stok Aktual</th>
 <th>Status</th>
 </tr>
 </thead>
 <tbody>
 @forelse($inventories as $index => $inv)
 <tr>
 <td class="text-center">{{ $index + 1 }}</td>
 <td>{{ $inv->product->sku ?? '-' }}</td>
 <td>{{ $inv->product->name ?? 'Produk Dihapus' }}</td>
 <td>{{ $inv->product->category->name ?? '-' }}</td>
 <td>{{ $inv->branch->name ?? '-' }}</td>
 <td class="text-center">{{ $inv->min_stock }}</td>
 <td class="text-right font-bold">{{ $inv->stock }}</td>
 <td>
 @if($inv->stock <= $inv->min_stock)
 <span class="text-danger">Kritis / Habis</span>
 @else
 Aman
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="8" class="text-center">Tidak ada data stok.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
</body>
</html>
