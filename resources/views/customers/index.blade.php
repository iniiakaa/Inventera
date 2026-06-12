<x-layouts.admin active="customers" title="Pelanggan - Inventera">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
        <div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Data Pelanggan</p>
            <h2 class="font-display text-display text-on-surface">Pelanggan</h2>
        </div>
        <button class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            <span>Tambah Pelanggan</span>
        </button>
    </header>
    <section class="liquid-glass rounded-xl p-12 flex flex-col items-center justify-center text-center min-h-[400px]">
        <span class="material-symbols-outlined text-[64px] text-on-surface-variant/40 mb-4" style="font-variation-settings: 'FILL' 1;">group</span>
        <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Daftar Pelanggan</h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-sm">Halaman ini akan menampilkan data pelanggan terdaftar beserta riwayat transaksi dan poin loyalitas.</p>
    </section>
    <div class="pb-12"></div>
</x-layouts.admin>
