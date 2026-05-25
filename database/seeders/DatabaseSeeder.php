<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed data awal untuk sistem Jayusman Retail Management.
     */
    public function run(): void
    {
        // 5 Cabang Mini-Market Jayusman
        $branches = [
            ['name' => 'Jakarta (HQ)',  'code' => 'JKT-01', 'city' => 'Jakarta',  'manager_name' => 'Ahmad Fauzi'],
            ['name' => 'Bandung',       'code' => 'BDG-01', 'city' => 'Bandung',  'manager_name' => 'Dewi Rahayu'],
            ['name' => 'Surabaya',      'code' => 'SBY-01', 'city' => 'Surabaya', 'manager_name' => 'Budi Santoso'],
            ['name' => 'Medan',         'code' => 'MDN-01', 'city' => 'Medan',    'manager_name' => 'Sari Wulandari'],
            ['name' => 'Makassar',      'code' => 'MKS-01', 'city' => 'Makassar', 'manager_name' => 'Reza Pratama'],
        ];

        foreach ($branches as $branch) {
            Branch::create(array_merge($branch, ['is_active' => true]));
        }

        // Akun Pemilik (Owner) — Pak Jayusman, akses ke semua cabang
        User::create([
            'name'       => 'Pak Jayusman',
            'email'      => 'owner@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'owner',
            'branch_id'  => null,   // null = akses semua cabang
        ]);

        // Akun Manager Cabang Jakarta
        $jakartaBranch = Branch::where('code', 'JKT-01')->first();
        User::create([
            'name'       => 'Ahmad Fauzi',
            'email'      => 'manager.jakarta@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'manager',
            'branch_id'  => $jakartaBranch->id,
        ]);

        // Akun Kasir Cabang Jakarta
        User::create([
            'name'       => 'Kasir Jaya',
            'email'      => 'kasir.jakarta@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'cashier',
            'branch_id'  => $jakartaBranch->id,
        ]);

        // Akun Supervisor Cabang Jakarta
        User::create([
            'name'       => 'Supervisor Santi',
            'email'      => 'supervisor.jakarta@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'supervisor',
            'branch_id'  => $jakartaBranch->id,
        ]);

        // Akun Staff Gudang Cabang Jakarta
        User::create([
            'name'       => 'Gudang Anto',
            'email'      => 'warehouse.jakarta@jayusman.id',
            'password'   => bcrypt('password'),
            'role'       => 'warehouse',
            'branch_id'  => $jakartaBranch->id,
        ]);

        // Dummy Kategori
        $kategoriMakanan = \App\Models\Category::create(['name' => 'Makanan Ringan', 'slug' => 'makanan-ringan']);
        $kategoriMinuman = \App\Models\Category::create(['name' => 'Minuman', 'slug' => 'minuman']);

        // Dummy Produk
        $produk1 = \App\Models\Product::create([
            'category_id' => $kategoriMakanan->id,
            'name' => 'Keripik Kentang Yummy',
            'sku' => 'KRY-001',
            'cost_price' => 5000,
            'selling_price' => 7500,
            'barcode' => '8991234567890'
        ]);

        $produk2 = \App\Models\Product::create([
            'category_id' => $kategoriMinuman->id,
            'name' => 'Air Mineral Segar 600ml',
            'sku' => 'AMS-600',
            'cost_price' => 2000,
            'selling_price' => 3500,
            'barcode' => '8990987654321'
        ]);

        // Dummy Inventory untuk Jakarta
        \App\Models\Inventory::create([
            'branch_id' => $jakartaBranch->id,
            'product_id' => $produk1->id,
            'stock' => 150,
            'min_stock' => 20
        ]);

        \App\Models\Inventory::create([
            'branch_id' => $jakartaBranch->id,
            'product_id' => $produk2->id,
            'stock' => 300,
            'min_stock' => 50
        ]);
    }
}
