<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\StockOpname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 5 Cabang Mini-Market Jayusman
        $branchesData = [
            ['name' => 'Jakarta (HQ)',  'code' => 'JKT-01', 'city' => 'Jakarta',  'manager_name' => 'Ahmad Fauzi'],
            ['name' => 'Bandung',       'code' => 'BDG-01', 'city' => 'Bandung',  'manager_name' => 'Dewi Rahayu'],
            ['name' => 'Surabaya',      'code' => 'SBY-01', 'city' => 'Surabaya', 'manager_name' => 'Budi Santoso'],
            ['name' => 'Medan',         'code' => 'MDN-01', 'city' => 'Medan',    'manager_name' => 'Sari Wulandari'],
            ['name' => 'Makassar',      'code' => 'MKS-01', 'city' => 'Makassar', 'manager_name' => 'Reza Pratama'],
        ];

        $branches = collect();
        foreach ($branchesData as $branchData) {
            $branches->push(Branch::create(array_merge($branchData, ['is_active' => true])));
        }

        // Akun Pemilik (Owner)
        User::create([
            'name'       => 'Pak Jayusman',
            'email'      => 'owner@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'owner',
            'branch_id'  => null,
        ]);

        $cashiers = collect();

        // Akun Staff untuk setiap cabang
        foreach ($branches as $branch) {
            $cityStr = strtolower($branch->city);
            
            // Manager
            User::create([
                'name'       => 'Manager ' . $branch->city,
                'email'      => "manager.{$cityStr}@jayusman.id",
                'password'   => bcrypt('password'),
                'role'       => 'manager',
                'branch_id'  => $branch->id,
            ]);

            // Supervisor
            User::create([
                'name'       => 'Supervisor ' . $branch->city,
                'email'      => "supervisor.{$cityStr}@jayusman.id",
                'password'   => bcrypt('password'),
                'role'       => 'supervisor',
                'branch_id'  => $branch->id,
            ]);

            // Kasir
            $cashier = User::create([
                'name'       => 'Kasir ' . $branch->city,
                'email'      => "kasir.{$cityStr}@jayusman.id",
                'password'   => bcrypt('password'),
                'role'       => 'cashier',
                'branch_id'  => $branch->id,
            ]);
            $cashiers->put($branch->id, $cashier->id);

            // Gudang
            User::create([
                'name'       => 'Gudang ' . $branch->city,
                'email'      => "warehouse.{$cityStr}@jayusman.id",
                'password'   => bcrypt('password'),
                'role'       => 'warehouse',
                'branch_id'  => $branch->id,
            ]);
        }

        // Dummy Kategori
        $kategoriMakanan = Category::create(['name' => 'Makanan Ringan', 'slug' => 'makanan-ringan']);
        $kategoriMinuman = Category::create(['name' => 'Minuman', 'slug' => 'minuman']);
        $kategoriSembako = Category::create(['name' => 'Sembako', 'slug' => 'sembako']);
        $kategoriMandi = Category::create(['name' => 'Kebutuhan Mandi', 'slug' => 'kebutuhan-mandi']);
        $kategoriElektronik = Category::create(['name' => 'Elektronik & Gadget', 'slug' => 'elektronik-gadget']);

        // Dummy Produk (Banyak produk baru)
        $productsData = [
            ['cat' => $kategoriMakanan->id, 'name' => 'Keripik Kentang Yummy', 'sku' => 'KRY-001', 'cost' => 5000, 'price' => 7500],
            ['cat' => $kategoriMakanan->id, 'name' => 'Biskuit Coklat Lezat', 'sku' => 'BCL-002', 'cost' => 4000, 'price' => 6000],
            ['cat' => $kategoriMakanan->id, 'name' => 'Kacang Panggang', 'sku' => 'KPG-003', 'cost' => 8000, 'price' => 12000],
            ['cat' => $kategoriMinuman->id, 'name' => 'Air Mineral Segar 600ml', 'sku' => 'AMS-600', 'cost' => 2000, 'price' => 3500],
            ['cat' => $kategoriMinuman->id, 'name' => 'Jus Jeruk Asli', 'sku' => 'JJA-002', 'cost' => 6000, 'price' => 9500],
            ['cat' => $kategoriMinuman->id, 'name' => 'Kopi Kaleng Moccacino', 'sku' => 'KKM-003', 'cost' => 5500, 'price' => 8000],
            ['cat' => $kategoriSembako->id, 'name' => 'Beras Putih Premium 5kg', 'sku' => 'BPP-5KG', 'cost' => 55000, 'price' => 65000],
            ['cat' => $kategoriSembako->id, 'name' => 'Minyak Goreng 2L', 'sku' => 'MGR-2L', 'cost' => 28000, 'price' => 34000],
            ['cat' => $kategoriSembako->id, 'name' => 'Gula Pasir 1kg', 'sku' => 'GLP-1KG', 'cost' => 12000, 'price' => 15000],
            ['cat' => $kategoriMandi->id, 'name' => 'Sabun Cair Anti-Bakteri 400ml', 'sku' => 'SCA-400', 'cost' => 18000, 'price' => 25000],
            ['cat' => $kategoriMandi->id, 'name' => 'Sampo Lidah Buaya 200ml', 'sku' => 'SLB-200', 'cost' => 15000, 'price' => 22000],
            ['cat' => $kategoriMandi->id, 'name' => 'Pasta Gigi Whitening 150g', 'sku' => 'PGW-150', 'cost' => 10000, 'price' => 14500],
            ['cat' => $kategoriElektronik->id, 'name' => 'Baterai AA Alkaline (Isi 4)', 'sku' => 'BAA-004', 'cost' => 12000, 'price' => 18000],
            ['cat' => $kategoriElektronik->id, 'name' => 'Kabel Data Type-C', 'sku' => 'KDC-001', 'cost' => 15000, 'price' => 35000],
        ];

        $products = collect();
        foreach ($productsData as $pd) {
            $products->push(Product::create([
                'category_id' => $pd['cat'],
                'name' => $pd['name'],
                'sku' => $pd['sku'],
                'cost_price' => $pd['cost'],
                'selling_price' => $pd['price'],
                'barcode' => rand(1000000000000, 9999999999999)
            ]));
        }

        // Dummy Inventory untuk semua cabang
        foreach ($branches as $branch) {
            foreach ($products as $product) {
                Inventory::create([
                    'branch_id' => $branch->id,
                    'product_id' => $product->id,
                    // Beberapa produk dibuat hampir habis agar Critical Stock alert muncul
                    'stock' => rand(1, 100) > 85 ? rand(5, 15) : rand(50, 300),
                    'min_stock' => rand(20, 50)
                ]);
            }
        }

        // Dummy Transaksi sebulan terakhir (60 hari ke belakang agar bisa banding bulan lalu)
        $paymentMethods = ['cash', 'debit', 'qris', 'transfer'];
        
        $startDate = now()->subDays(60);
        $endDate = now();
        $invoiceCounter = 1;

        for ($date = clone $startDate; $date->lte($endDate); $date->addDay()) {
            foreach ($branches as $branch) {
                // Tiap cabang per hari ada 3-8 transaksi acak
                $trxCount = rand(3, 8);
                for ($i = 0; $i < $trxCount; $i++) {
                    $cashierId = $cashiers[$branch->id];
                    $method = $paymentMethods[array_rand($paymentMethods)];
                    
                    // Buat header transaksi (tanpa total dulu)
                    $trx = Transaction::withoutGlobalScopes()->create([
                        'invoice_number' => 'INV-' . $branch->code . '-' . $date->format('Ymd') . '-' . str_pad($invoiceCounter++, 4, '0', STR_PAD_LEFT),
                        'branch_id' => $branch->id,
                        'user_id' => $cashierId,
                        'subtotal' => 0,
                        'discount_amount' => 0,
                        'tax_amount' => 0,
                        'total_amount' => 0,
                        'payment_method' => $method,
                        'status' => 'completed',
                        'created_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)), // waktu acak
                        'updated_at' => $date->copy()
                    ]);

                    $totalTrx = 0;
                    // Beli 1-4 produk per transaksi
                    $itemsCount = rand(1, 4);
                    $boughtProducts = $products->random($itemsCount);
                    
                    foreach ($boughtProducts as $bp) {
                        $qty = rand(1, 3);
                        $subtotal = $bp->selling_price * $qty;
                        $totalTrx += $subtotal;

                        TransactionItem::create([
                            'transaction_id' => $trx->id,
                            'product_id' => $bp->id,
                            'quantity' => $qty,
                            'unit_price' => $bp->selling_price,
                            'discount_per_item' => 0,
                            'subtotal' => $subtotal,
                            'created_at' => $trx->created_at,
                            'updated_at' => $trx->created_at,
                        ]);
                    }

                    // Update total header
                    $tax = $totalTrx * 0.11; // 11% PPN dummy
                    $grandTotal = $totalTrx + $tax;

                    $trx->update([
                        'subtotal' => $totalTrx,
                        'tax_amount' => $tax,
                        'total_amount' => $grandTotal,
                        'amount_paid' => $method == 'cash' ? ceil($grandTotal / 5000) * 5000 : $grandTotal,
                        'change_amount' => $method == 'cash' ? (ceil($grandTotal / 5000) * 5000) - $grandTotal : 0,
                    ]);
                }
            }
        }

        // Dummy Stock Opname (2 bulan terakhir)
        foreach ($branches as $branch) {
            $soCount = rand(5, 10);
            for ($k = 0; $k < $soCount; $k++) {
                $product = $products->random();
                $systemStock = rand(50, 200);
                $diff = rand(-5, 5); // Ada selisih kurang atau lebih
                $physStock = $systemStock + $diff;
                $statusList = ['pending', 'approved', 'rejected'];

                StockOpname::create([
                    'branch_id' => $branch->id,
                    'product_id' => $product->id,
                    'user_id' => $cashiers[$branch->id], // pura-puranya kasir/gudang yang buat
                    'approver_id' => null,
                    'system_stock' => $systemStock,
                    'physical_stock' => $physStock,
                    'difference' => $diff,
                    'reason' => $diff < 0 ? 'Barang hilang/rusak' : ($diff > 0 ? 'Kelebihan kirim' : 'Sesuai'),
                    'status' => $statusList[array_rand($statusList)],
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now()
                ]);
            }
        }

    }
}
