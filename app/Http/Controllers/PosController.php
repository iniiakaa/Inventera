<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id;
        
        // Kasir harus punya branch_id
        if (!$branchId) {
            abort(403, 'Akses ditolak. Anda tidak memiliki cabang aktif untuk melakukan penjualan.');
        }

        $categories = Category::all();
        // Load inventory yang punya stok di cabang ini
        $inventories = Inventory::with('product')
            ->where('branch_id', $branchId)
            ->where('stock', '>', 0)
            ->get();

        $inventoryData = $inventories->map(function($inv) {
            return [
                'inventory_id' => $inv->id,
                'product_id' => $inv->product_id,
                'category_id' => $inv->product->category_id,
                'name' => $inv->product->name,
                'sku' => $inv->product->sku,
                'price' => $inv->product->selling_price,
                'stock' => $inv->stock
            ];
        });

        return view('pos.index', compact('categories', 'inventoryData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.inventory_id' => 'required|exists:inventories,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $branchId = Auth::user()->branch_id;
        if (!$branchId) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $itemsData = [];

            // 1. Validasi stok & hitung total
            foreach ($request->cart as $item) {
                $inventory = Inventory::with('product')->lockForUpdate()->find($item['inventory_id']);
                
                if (!$inventory || $inventory->branch_id !== $branchId) {
                    throw new \Exception("Item tidak ditemukan di cabang Anda.");
                }

                if ($inventory->stock < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup untuk produk: " . $inventory->product->name);
                }

                $subtotal = $inventory->product->selling_price * $item['quantity'];
                $totalAmount += $subtotal;

                $itemsData[] = [
                    'inventory' => $inventory,
                    'quantity' => $item['quantity'],
                    'price' => $inventory->product->selling_price,
                    'subtotal' => $subtotal
                ];
            }

            if ($request->amount_paid < $totalAmount) {
                throw new \Exception("Jumlah uang bayar tidak mencukupi.");
            }

            // 2. Buat Transaksi
            $transaction = Transaction::create([
                'branch_id' => $branchId,
                'cashier_id' => Auth::id(),
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
                'amount_paid' => $request->amount_paid,
                'change_amount' => $request->amount_paid - $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
            ]);

            // 3. Simpan Item Transaksi & Kurangi Stok
            foreach ($itemsData as $data) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $data['inventory']->product_id,
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                    'subtotal' => $data['subtotal']
                ]);

                // Kurangi stok
                $data['inventory']->decrement('stock', $data['quantity']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil!',
                'transaction' => $transaction
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
