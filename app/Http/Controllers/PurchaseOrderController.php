<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $query = PurchaseOrder::with(['supplier', 'user', 'branch'])->orderBy('created_at', 'desc');
        
        if ($user->role === 'manager' || $user->role === 'warehouse') {
            $query->where('branch_id', $user->branch_id);
        }

        $purchaseOrders = $query->get();

        return view('purchase-orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $user = Auth::user();
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        
        if ($user->role === 'owner') {
            $branches = Branch::where('is_active', true)->orderBy('name')->get();
        } else {
            $branches = Branch::where('id', $user->branch_id)->get();
        }

        return view('purchase-orders.create', compact('suppliers', 'products', 'branches'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'branch_id' => 'required|exists:branches,id',
            'expected_at' => 'nullable|date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity_ordered' => 'required|integer|min:1',
            'items.*.unit_cost' => 'required|numeric|min:0',
        ]);

        if ($user->role !== 'owner' && $validated['branch_id'] != $user->branch_id) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity_ordered'] * $item['unit_cost'];
                $totalAmount += $subtotal;
                $itemsData[] = [
                    'product_id' => $item['product_id'],
                    'quantity_ordered' => $item['quantity_ordered'],
                    'quantity_received' => 0,
                    'unit_cost' => $item['unit_cost'],
                    'subtotal' => $subtotal,
                ];
            }

            // Generate PO Number
            $poNumber = 'PO-' . date('Ymd') . '-' . rand(1000, 9999);

            $po = PurchaseOrder::create([
                'po_number' => $poNumber,
                'branch_id' => $validated['branch_id'],
                'supplier_id' => $validated['supplier_id'],
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'draft',
                'ordered_at' => now(),
                'expected_at' => $validated['expected_at'],
                'notes' => $validated['notes'],
            ]);

            foreach ($itemsData as $itemData) {
                $itemData['purchase_order_id'] = $po->id;
                PurchaseOrderItem::create($itemData);
            }

            DB::commit();

            return redirect()->route('purchase-orders.index')->with('success', 'Purchase Order berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        $user = Auth::user();
        if ($user->role !== 'owner' && $purchaseOrder->branch_id != $user->branch_id) {
            return redirect()->route('purchase-orders.index')->with('error', 'Akses ditolak.');
        }

        $purchaseOrder->load('items.product', 'supplier', 'branch');
        return view('purchase-orders.edit', compact('purchaseOrder'));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $user = Auth::user();
        if ($user->role !== 'owner' && $purchaseOrder->branch_id != $user->branch_id) {
            return redirect()->route('purchase-orders.index')->with('error', 'Akses ditolak.');
        }

        if ($purchaseOrder->status === 'received') {
            return redirect()->route('purchase-orders.index')->with('error', 'PO yang sudah diterima tidak dapat diubah.');
        }

        $validated = $request->validate([
            'status' => 'required|in:draft,sent,received,cancelled',
        ]);

        DB::beginTransaction();

        try {
            $purchaseOrder->update(['status' => $validated['status']]);

            // Jika status diubah menjadi received, update stok
            if ($validated['status'] === 'received') {
                $purchaseOrder->update(['received_at' => now()]);

                foreach ($purchaseOrder->items as $item) {
                    $item->update(['quantity_received' => $item->quantity_ordered]);

                    $inventory = Inventory::firstOrCreate(
                        ['product_id' => $item->product_id, 'branch_id' => $purchaseOrder->branch_id],
                        ['stock' => 0, 'min_stock' => 5]
                    );

                    $inventory->increment('stock', $item->quantity_received);
                }
            }

            DB::commit();
            return redirect()->route('purchase-orders.index')->with('success', 'Status PO berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
