<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Helper untuk cek akses Read-Only
    private function isReadOnly($user) {
        return in_array($user->role, ['owner', 'supervisor']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'manager') {
            $employees = User::with('branch')
                ->where('branch_id', $user->branch_id)
                ->orderBy('name')
                ->get();
        } else {
            $employees = User::with('branch')->orderBy('name')->get();
        }

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');
        
        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        $roles = ($user->role === 'manager') ? ['warehouse', 'cashier'] : ['owner', 'manager', 'supervisor', 'warehouse', 'cashier'];

        return view('employees.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');

        $allowedRoles = ($user->role === 'manager') ? 'warehouse,cashier' : 'owner,manager,supervisor,warehouse,cashier';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:' . $allowedRoles,
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = true;

        if ($user->role === 'manager') {
            $validated['branch_id'] = $user->branch_id;
        }

        User::create($validated);
        return redirect()->route('employees')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $employee = User::findOrFail($id);

        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');

        if ($user->role === 'manager') {
            if ($employee->branch_id !== $user->branch_id || !in_array($employee->role, ['warehouse', 'cashier'])) {
                return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses.');
            }
            $roles = ['warehouse', 'cashier'];
        } else {
            $roles = ['owner', 'manager', 'supervisor', 'warehouse', 'cashier'];
        }
        
        $branches = Branch::where('is_active', true)->orderBy('name')->get();
        return view('employees.edit', compact('employee', 'branches', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');
        
        $employee = User::findOrFail($id);
        // Tambahkan validasi sesuai kebutuhan...
        $employee->update($request->all());
        return redirect()->route('employees')->with('success', 'Data diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');
        
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $user = Auth::user();
        $employee = User::findOrFail($id);
        
        if ($this->isReadOnly($user)) return redirect()->route('employees')->with('error', 'Akses ditolak.');

        if ($user->role === 'manager' && ($employee->branch_id !== $user->branch_id || in_array($employee->role, ['owner', 'manager', 'supervisor']))) {
            return redirect()->route('employees')->with('error', 'Anda tidak memiliki hak akses.');
        }

        $employee->update(['is_active' => !$employee->is_active]);
        return redirect()->route('employees')->with('success', 'Status karyawan diperbarui.');
    }
}