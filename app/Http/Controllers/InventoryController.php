<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Inventory::with(['product.category', 'branch'])->orderBy('id', 'desc');

        if ($user->role === 'owner' || $user->role === 'manager') {
            if ($request->has('branch_id') && $request->branch_id != '') {
                $query->where('branch_id', $request->branch_id);
            }
            $branches = Branch::where('is_active', true)->get();
        } else {
            $query->where('branch_id', $user->branch_id);
            $branches = collect();
        }

        $inventories = $query->paginate(20);
        return view('inventory.index', compact('inventories', 'branches', 'user'));
    }

    public function create()
    {
        // "Barang Masuk"
        $user = Auth::user();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        
        if ($user->role === 'owner' || $user->role === 'manager') {
            $branches = Branch::where('is_active', true)->get();
        } else {
            $branches = Branch::where('id', $user->branch_id)->get();
        }

        return view('inventory.create', compact('products', 'branches'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($user->role !== 'owner' && $user->role !== 'manager' && $validated['branch_id'] != $user->branch_id) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $inventory = Inventory::firstOrCreate(
            ['branch_id' => $validated['branch_id'], 'product_id' => $validated['product_id']],
            ['stock' => 0, 'min_stock' => 5]
        );

        $inventory->increment('stock', $validated['quantity']);
        $inventory->update(['last_restocked_at' => now()]);

        return redirect()->route('inventory.index')->with('success', 'Barang masuk berhasil ditambahkan ke inventaris.');
    }

    public function edit(Inventory $inventory)
    {
        $user = Auth::user();
        if ($user->role !== 'owner' && $user->role !== 'manager' && $inventory->branch_id != $user->branch_id) {
            return redirect()->route('inventory.index')->with('error', 'Akses ditolak.');
        }

        $inventory->load('product', 'branch');
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $user = Auth::user();
        if ($user->role !== 'owner' && $user->role !== 'manager' && $inventory->branch_id != $user->branch_id) {
            return redirect()->route('inventory.index')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventory $inventory)
    {
        $user = Auth::user();
        if ($user->role !== 'owner' && $user->role !== 'manager' && $inventory->branch_id != $user->branch_id) {
            return redirect()->route('inventory.index')->with('error', 'Akses ditolak.');
        }

        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Data inventaris berhasil dihapus.');
    }
}
