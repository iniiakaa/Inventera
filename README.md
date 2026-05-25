# 🏬 Inventera - Minimarket Management & POS System

<p align="center">
  <strong>Solusi Terintegrasi Pengawasan Real-Time & POS Multi-Cabang untuk Jayusman Retail</strong>
</p>

---

## 📌 Deskripsi Proyek
**Inventera** adalah sistem manajemen mini-market terpusat yang dirancang khusus untuk memenuhi kebutuhan operasional **Bapak Jayusman**. Dengan memiliki 5 cabang retail di berbagai kota, sistem ini memfasilitasi pemantauan transaksi *real-time*, manajemen stok aman terisolasi antar cabang (*multi-tenant*), pencegahan manipulasi data (*audit logs*), serta sistem Point of Sales (POS) kasir berkinerja tinggi.

Aplikasi ini dibangun di atas kerangka kerja **Laravel** dan database **MySQL** dengan penekanan pada estetika antarmuka premium (**Modern Soft UI / Liquid Glass UI**) serta isolasi data yang ketat (*zero-leakage tenancy*).

---

## 📂 Peta Dokumentasi Proyek

Untuk memudahkan Anda memahami dan melanjutkan pengembangan proyek ini, silakan merujuk ke dokumen-dokumen blueprint berikut:

*   **[📘 Product Requirements Document (PRD)](file:///f:/LaravelHerd/Inventera/prd_minimarket.md)**
    Dokumen persyaratan bisnis utama, target personalia, arsitektur visual premium, spesifikasi non-fungsional, dan tujuan bisnis Pak Jayusman.
*   **[📋 Skema Use Case & Blueprint Sistem](file:///f:/LaravelHerd/Inventera/README_USECASE.md)** *(Baru Dibuat)*
    Diagram Use Case interaktif (Mermaid), spesifikasi detail alur otorisasi void kasir, alur stock opname gudang, penjelasan isolasi data multi-tenant (Eloquent Global Scope), serta langkah-langkah implementasi berikutnya.
*   **[📘 Dokumentasi FinVault Admin Panel](file:///f:/LaravelHerd/Inventera/documentation.md)**
    Dokumentasi struktur folder, routing awal, aset desain, visual styling, dan referensi komponen blade.

---

## 🛠️ Stack Teknologi

Sistem dibangun menggunakan kombinasi teknologi terbaik untuk aplikasi internal enterprise (*Golden Stack*):
*   **Backend & Framework:** Laravel 11+ / PHP 8.2+
*   **Admin Panel / CRUD Engine:** Filament PHP (Livewire 3)
*   **Frontend Styling:** Tailwind CSS & Custom CSS (Varian Liquid Glass / Soft UI)
*   **Database:** MySQL 8+
*   **Security & Logs:** Spatie Laravel Permission & Spatie Activitylog

---

## 🚀 Perintah Dasar Pengembangan

Untuk memulai server pengembangan lokal Anda:

```bash
# 1. Install dependensi PHP
composer install

# 2. Install dependensi Node.js
npm install

# 3. Jalankan server database dan migrasi
php artisan migrate:fresh --seed

# 4. Jalankan Laravel development server
php artisan serve

# 5. Jalankan compiler asset frontend (Vite)
npm run dev
```

---

*Dokumen ini diperbarui secara berkala sebagai portal navigasi utama repositori **Inventera**.*
