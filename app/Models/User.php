<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([BranchScope::class])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'branch_id',
        'is_active', // Ditambahkan agar bisa di-update via mass assignment
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean', // Ditambahkan agar 1/0 otomatis jadi true/false
        ];
    }

    /**
     * Relasi ke cabang (null = owner, akses semua cabang).
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Cek apakah user adalah pemilik (owner).
     */
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    /**
     * Cek apakah user adalah manajer cabang.
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Cek apakah user adalah kasir.
     */
    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }
    
    /**
     * Cek apakah user adalah supervisor.
     */
    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    /**
     * Cek apakah user adalah staf gudang.
     */
    public function isWarehouse(): bool
    {
        return $this->role === 'warehouse';
    }
}