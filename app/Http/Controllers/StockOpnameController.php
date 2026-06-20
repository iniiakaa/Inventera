<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $query = StockOpname::with(['product', 'user', 'approver', 'branch'])->orderBy('created_at', 'desc');
        
        if ($user->role === 'manager' || $user->role === 'warehouse' || $user->role === 'supervisor') {
            $query->where('branch_id', $user->branch_id);
        }

        $stockOpnames = $query->get();

        return view('stock-opnames.index', compact('stockOpnames'));
    }

    public function create()
    {
        $user = Auth::user();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('stock-opnames.create', compact('products'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:1000',
        ]);

        $inventory = Inventory::firstOrCreate(
            ['product_id' => $validated['product_id'], 'branch_id' => $user->branch_id],
            ['stock' => 0, 'min_stock' => 5]
        );

        $difference = $validated['physical_stock'] - $inventory->stock;

        if ($difference == 0) {
            return redirect()->back()->with('error', 'Stok fisik sama dengan stok sistem, tidak ada penyesuaian yang perlu diajukan.');
        }

        StockOpname::create([
            'branch_id' => $user->branch_id,
            'product_id' => $validated['product_id'],
            'user_id' => $user->id,
            'system_stock' => $inventory->stock,
            'physical_stock' => $validated['physical_stock'],
            'difference' => $difference,
            'reason' => $validated['reason'],
            'status' => 'pending'
        ]);

        return redirect()->route('stock-opnames.index')->with('success', 'Pengajuan Stock Opname berhasil dibuat dan menunggu persetujuan.');
    }

    public function edit(StockOpname $stockOpname)
    {
        $user = Auth::user();
        if (!in_array($user->role, ['owner', 'manager', 'supervisor'])) {
            return redirect()->route('stock-opnames.index')->with('error', 'Akses ditolak.');
        }

        if ($user->role !== 'owner' && $stockOpname->branch_id != $user->branch_id) {
            return redirect()->route('stock-opnames.index')->with('error', 'Akses ditolak.');
        }

        $stockOpname->load('product', 'user', 'branch');
        return view('stock-opnames.edit', compact('stockOpname'));
    }

    public function update(Request $request, StockOpname $stockOpname)
    {
        $user = Auth::user();
        if (!in_array($user->role, ['owner', 'manager', 'supervisor'])) {
            return redirect()->route('stock-opnames.index')->with('error', 'Akses ditolak.');
        }

        if ($stockOpname->status !== 'pending') {
            return redirect()->route('stock-opnames.index')->with('error', 'Pengajuan ini sudah diproses.');
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        DB::beginTransaction();

        try {
            $stockOpname->update([
                'status' => $validated['status'],
                'approver_id' => $user->id,
            ]);

            if ($validated['status'] === 'approved') {
                $inventory = Inventory::where('product_id', $stockOpname->product_id)
                                      ->where('branch_id', $stockOpname->branch_id)
                                      ->first();
                if ($inventory) {
                    // Update ke physical stock
                    $inventory->update(['stock' => $stockOpname->physical_stock]);
                }
            }

            DB::commit();
            return redirect()->route('stock-opnames.index')->with('success', 'Stock Opname berhasil diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
