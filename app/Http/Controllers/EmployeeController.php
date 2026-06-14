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
        $user = auth()->user();

        // Jika Manager, hanya tampilkan karyawan di cabang yang sama dengannya
        if ($user->role === 'manager') {
            $employees = User::with('branch')
                ->where('branch_id', $user->branch_id)
                ->whereIn('role', ['warehouse', 'cashier']) // Tambahan: batasi role yang muncul di tabel manajer
                ->orderBy('name')
                ->get();
        } else {
            // Owner/Admin bisa melihat semua
            $employees = User::with('branch')->orderBy('name')->get();
        }

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        
        if (auth()->user()->role === 'manager') {
            $roles = ['warehouse', 'cashier'];
        } else {
            $roles = ['owner', 'manager', 'supervisor', 'warehouse', 'cashier'];
        }

        return view('employees.create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $allowedRoles = $user->role === 'manager' ? 'warehouse,cashier' : 'owner,manager,supervisor,warehouse,cashier';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:' . $allowedRoles,
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = true;

        // FORCE BRANCH: Jika Manajer, paksa karyawan baru masuk ke cabang si Manajer
        if ($user->role === 'manager') {
            $validated['branch_id'] = $user->branch_id;
        }

        User::create($validated);

        return redirect()->route('employees')->with('success', 'Karyawan berhasil ditambahkan ke cabang Anda.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $employee = User::findOrFail($id);

        // Proteksi: Manajer hanya bisa edit karyawan di cabangnya sendiri
        if ($user->role === 'manager' && $employee->branch_id !== $user->branch_id) {
            return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses ke karyawan cabang lain.');
        }

        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        
        if ($user->role === 'manager') {
            $roles = ['warehouse', 'cashier'];
            if (in_array($employee->role, ['owner', 'manager', 'supervisor'])) {
                return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses untuk mengubah data ini.');
            }
        } else {
            $roles = ['owner', 'manager', 'supervisor', 'warehouse', 'cashier'];
        }
        
        return view('employees.edit', compact('employee', 'branches', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $employee = User::findOrFail($id);

        // Proteksi: Manajer tidak boleh edit data lintas cabang atau hirarki atas
        if ($user->role === 'manager') {
            if ($employee->branch_id !== $user->branch_id || in_array($employee->role, ['owner', 'manager', 'supervisor'])) {
                return redirect()->route('employees')->with('error', 'Akses ditolak.');
            }
        }

        $allowedRoles = $user->role === 'manager' ? 'warehouse,cashier' : 'owner,manager,supervisor,warehouse,cashier';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'role' => 'required|string|in:' . $allowedRoles,
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = bcrypt($request->password);
        }

        // FORCE BRANCH pada update: Pastikan branch_id tidak berubah
        if ($user->role === 'manager') {
            $validated['branch_id'] = $user->branch_id;
        }

        $employee->update($validated);

        return redirect()->route('employees')->with('success', 'Data karyawan diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $employee = User::findOrFail($id);
        
        // Proteksi: Manajer tidak boleh hapus karyawan cabang lain
        if ($user->role === 'manager' && $employee->branch_id !== $user->branch_id) {
             return redirect()->route('employees')->with('error', 'Akses ditolak.');
        }

        if ($user->role === 'manager' && in_array($employee->role, ['owner', 'manager', 'supervisor'])) {
            return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses.');
        }

        $employee->delete();
        return redirect()->route('employees')->with('success', 'Karyawan berhasil dihapus.');
    }

    /**
     * Toggle status aktif / nonaktif.
     */
    public function toggleStatus($id)
    {
        $user = auth()->user();
        $employee = User::findOrFail($id);
        
        // Proteksi: Manajer tidak boleh ubah status karyawan cabang lain
        if ($user->role === 'manager' && $employee->branch_id !== $user->branch_id) {
             return redirect()->route('employees')->with('error', 'Akses ditolak.');
        }

        if ($user->role === 'manager' && in_array($employee->role, ['owner', 'manager', 'supervisor'])) {
            return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses.');
        }

        $employee->update(['is_active' => !$employee->is_active]);
        return redirect()->route('employees')->with('success', 'Status karyawan diperbarui.');
    }
}