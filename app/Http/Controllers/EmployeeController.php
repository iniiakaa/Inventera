<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Branch;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data karyawan (baik aktif maupun nonaktif) beserta data cabangnya
        $employees = User::with('branch')->orderBy('name')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data cabang aktif untuk pilihan select box di form tambah karyawan
        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        return view('employees.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:owner,manager,supervisor,warehouse,cashier',
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = true; // Otomatis aktif saat dibuat

        User::create($validated);

        return redirect()->route('employees')->with('success', 'Karyawan baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        
        return view('employees.edit', compact('employee', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'role' => 'required|string|in:owner,manager,supervisor,warehouse,cashier',
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = bcrypt($request->password);
        }

        $validated['is_active'] = $request->has('is_active');

        $employee->update($validated);

        return redirect()->route('employees')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (Toggle Soft Deactivate).
     */
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        
        // Mengubah status secara dinamis: jika aktif jadi nonaktif, jika nonaktif jadi aktif
        $newStatus = !$employee->is_active;
        $employee->update(['is_active' => $newStatus]);

        $statusPesan = $newStatus ? 'diaktifkan kembali.' : 'berhasil dinonaktifkan.';
        
        return redirect()->route('employees')->with('success', 'Karyawan ' . $statusPesan);
    }
}