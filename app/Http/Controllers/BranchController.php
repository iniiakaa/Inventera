<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    // Middleware proteksi: Hanya Owner yang bisa akses selain index
    private function checkOwner() {
        if (Auth::user()->role !== 'owner') {
            return redirect()->route('branches.index')->with('error', 'Akses ditolak.');
        }
        return null;
    }

    public function index()
    {
        $branches = Branch::orderBy('name')->get();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        $this->checkOwner();
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $this->checkOwner();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:branches,code',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'manager_email' => 'required|email|unique:users,email',
            'manager_password' => 'required|min:8',
            'is_active' => 'nullable',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // 1. Buat Cabang
            $branch = Branch::create([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'manager_name' => $validated['manager_name'],
                'is_active' => $request->has('is_active'),
            ]);

            // 2. Buat Akun Manager
            User::create([
                'name' => $validated['manager_name'] ?? 'Manager ' . $validated['name'],
                'email' => $validated['manager_email'],
                'password' => Hash::make($validated['manager_password']),
                'role' => 'manager',
                'branch_id' => $branch->id,
                'is_active' => true,
            ]);
        });

        return redirect()->route('branches.index')->with('success', 'Cabang dan Akun Manajer berhasil dibuat.');
    }

    public function edit(Branch $branch)
    {
        $this->checkOwner();
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $this->checkOwner();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:branches,code,' . $branch->id,
            'city' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $branch->update($validated);

        return redirect()->route('branches.index')->with('success', 'Data cabang berhasil diperbarui.');
    }

    public function destroy(Branch $branch)
    {
        $this->checkOwner();
        $branch->update(['is_active' => false]);
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil dinonaktifkan.');
    }
}