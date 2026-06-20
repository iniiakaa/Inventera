{{-- Search Dropdown — sama gaya dengan notif-dropdown --}}
<div class="relative" id="search-wrapper">

 <!-- Search Button -->
 <button id="search-btn" onclick="toggleSearch()"
 class="relative w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant transition-all duration-200 hover:text-on-surface"
 style="background: rgba(255,255,255,0.25); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);"
 aria-label="Cari">
 <span id="search-icon" class="material-symbols-outlined text-[20px]">search</span>
 </button>

 <!-- Dropdown Panel -->
 <div id="search-dropdown"
 class="search-dropdown absolute right-0 mt-3 w-[420px] z-50 origin-top-right rounded-[24px]"
 aria-hidden="true">

 <!-- Search Input Bar -->
 <div class="px-4 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.25);">
 <div class="flex items-center gap-3 px-4 py-2.5 rounded-full"
 style="background: rgba(255,255,255,0.35); border: 1px solid rgba(255,255,255,0.5);">
 <span class="material-symbols-outlined text-[18px] text-on-surface-variant flex-shrink-0">search</span>
 <input
 id="search-input"
 type="text"
 placeholder="Cari produk, SKU, transaksi, karyawan..."
 autocomplete="off"
 oninput="handleSearch(this.value)"
 class="flex-1 bg-transparent border-none outline-none ring-0 shadow-none focus:ring-0 focus:outline-none focus:border-none focus:shadow-none font-label-md text-label-md text-on-surface placeholder:text-on-surface-variant/50"
 style="box-shadow: none !important; outline: none !important;"
 />
 <button onclick="clearSearch()" id="search-clear"
 class="hidden text-on-surface-variant hover:text-on-surface transition-colors">
 <span class="material-symbols-outlined text-[16px]">close</span>
 </button>
 <kbd class="hidden md:inline-flex font-label-sm text-label-sm text-on-surface-variant/50 px-1.5 py-0.5 rounded-md border border-white/30 text-[10px]">ESC</kbd>
 </div>
 </div>

 <!-- Quick Links (default state) -->
 <div id="search-quick" class="py-2">
 <p class="px-5 pt-2 pb-1 font-label-sm text-label-sm text-on-surface-variant/60 uppercase tracking-widest">Akses Cepat</p>
 <a href="{{ route('transactions') }}" class="search-result-item flex items-center gap-3 px-5 py-3">
 <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
 style="background: rgba(0,88,188,0.1);">
 <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings:'FILL' 1;">point_of_sale</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">Transaksi</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/70">Daftar transaksi & POS</p>
 </div>
 <span class="material-symbols-outlined text-[16px] text-on-surface-variant/40 ml-auto">arrow_forward</span>
 </a>
 <a href="{{ route('inventory.index') }}" class="search-result-item flex items-center gap-3 px-5 py-3">
 <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
 style="background: rgba(158,61,0,0.1);">
 <span class="material-symbols-outlined text-[16px] text-tertiary" style="font-variation-settings:'FILL' 1;">inventory_2</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">Inventaris</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/70">Cek stok & barang masuk</p>
 </div>
 <span class="material-symbols-outlined text-[16px] text-on-surface-variant/40 ml-auto">arrow_forward</span>
 </a>
 <a href="{{ route('reports.index') }}" class="search-result-item flex items-center gap-3 px-5 py-3">
 <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
 style="background: rgba(0,110,40,0.1);">
 <span class="material-symbols-outlined text-[16px] text-secondary" style="font-variation-settings:'FILL' 1;">assessment</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">Laporan</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/70">Omzet, laba & performa cabang</p>
 </div>
 <span class="material-symbols-outlined text-[16px] text-on-surface-variant/40 ml-auto">arrow_forward</span>
 </a>
 </div>

 <!-- Search Results (muncul saat mengetik) -->
 <div id="search-results" class="hidden py-2">
 <p class="px-5 pt-2 pb-1 font-label-sm text-label-sm text-on-surface-variant/60 uppercase tracking-widest">Hasil Pencarian</p>
 <div id="search-results-list"></div>
 <div id="search-empty" class="hidden flex flex-col items-center py-8 gap-2">
 <span class="material-symbols-outlined text-[36px] text-on-surface-variant/30">search_off</span>
 <p class="font-label-md text-label-md text-on-surface-variant/50">Tidak ada hasil ditemukan</p>
 </div>
 </div>

 <!-- Footer hint -->
 <div class="px-5 py-3 flex items-center gap-4" style="border-top: 1px solid rgba(255,255,255,0.25);">
 <span class="flex items-center gap-1.5 font-label-sm text-label-sm text-on-surface-variant/50">
 <kbd class="px-1.5 py-0.5 rounded border border-white/30 text-[10px]">↵</kbd> Buka
 </span>
 <span class="flex items-center gap-1.5 font-label-sm text-label-sm text-on-surface-variant/50">
 <kbd class="px-1.5 py-0.5 rounded border border-white/30 text-[10px]">↑↓</kbd> Navigasi
 </span>
 <span class="flex items-center gap-1.5 font-label-sm text-label-sm text-on-surface-variant/50 ml-auto">
 <kbd class="px-1.5 py-0.5 rounded border border-white/30 text-[10px]">ESC</kbd> Tutup
 </span>
 </div>

 </div>
</div>

<style>
 /* Hapus outline biru bawaan browser & Tailwind Forms */
 #search-input,
 #search-input:focus,
 #search-input:focus-visible {
 outline: none !important;
 box-shadow: none !important;
 border: none !important;
 ring: 0 !important;
 }

 /* ── Search Dropdown — sama dengan #notif-dropdown ── */
 #search-dropdown {
 background: rgba(235, 240, 255, 0.38);
 backdrop-filter: blur(8px) saturate(1.8) brightness(1.06) contrast(0.96);
 -webkit-backdrop-filter: blur(8px) saturate(1.8) brightness(1.06) contrast(0.96);
 border: 1px solid rgba(255, 255, 255, 0.72);
 box-shadow:
 0 8px 32px rgba(0, 0, 0, 0.07),
 0 40px 80px rgba(0, 0, 0, 0.09),
 inset 0 1.5px 0 rgba(255, 255, 255, 0.92),
 inset 0 -1px 0 rgba(0, 0, 0, 0.05);
 overflow: clip;
 }

 /* Shimmer — identik dengan notif */
 #search-dropdown::before {
 content: '';
 position: absolute;
 inset: 0;
 border-radius: inherit;
 background: linear-gradient(140deg,
 rgba(255, 255, 255, 0.42) 0%,
 rgba(255, 255, 255, 0.04) 45%,
 rgba(180, 200, 255, 0.06) 75%,
 rgba(255, 255, 255, 0.22) 100%);
 pointer-events: none;
 z-index: 0;
 }

 #search-dropdown > * {
 position: relative;
 z-index: 1;
 }

 /* ── Animasi (sama persis dengan notif-dropdown) ── */
 .search-dropdown {
 pointer-events: none;
 opacity: 0;
 transform: scale(0.92) translateY(-8px);
 transform-origin: top right;
 transition:
 opacity 0.28s cubic-bezier(0.32, 0.72, 0, 1),
 transform 0.28s cubic-bezier(0.32, 0.72, 0, 1);
 will-change: transform, opacity;
 }

 .search-dropdown.open {
 pointer-events: auto;
 opacity: 1;
 transform: scale(1) translateY(0);
 }

 /* Item hover & animation */
 .search-result-item {
 cursor: pointer;
 transition: background 0.18s ease;
 text-decoration: none;
 }

 .search-result-item:hover {
 background: rgba(255, 255, 255, 0.3);
 }

 @keyframes fadeInUpSearchItem {
 from {
 opacity: 0;
 transform: translateY(15px);
 }
 to {
 transform: translateY(0);
 }
 }

 .search-dropdown.open .search-result-item {
 animation: fadeInUpSearchItem 0.4s cubic-bezier(0.32, 0.72, 0, 1) both;
 }
 
 .search-dropdown.open .search-result-item:nth-of-type(1) { animation-delay: 0.10s; }
 .search-dropdown.open .search-result-item:nth-of-type(2) { animation-delay: 0.15s; }
 .search-dropdown.open .search-result-item:nth-of-type(3) { animation-delay: 0.20s; }
 .search-dropdown.open .search-result-item:nth-of-type(4) { animation-delay: 0.25s; }
 .search-dropdown.open .search-result-item:nth-of-type(5) { animation-delay: 0.30s; }
 .search-dropdown.open .search-result-item:nth-of-type(6) { animation-delay: 0.35s; }
 .search-dropdown.open .search-result-item:nth-of-type(7) { animation-delay: 0.40s; }
 .search-dropdown.open .search-result-item:nth-of-type(8) { animation-delay: 0.45s; }

 /* Scrollbar */
 #search-dropdown ::-webkit-scrollbar { width: 4px; }
 #search-dropdown ::-webkit-scrollbar-track { background: transparent; }
 #search-dropdown ::-webkit-scrollbar-thumb { background: rgba(0,88,188,0.2); border-radius: 9999px; }
</style>

<script>
 /* ── Data pencarian lokal dengan filter role ── */
 @php $role = Auth::user()->role ?? ''; @endphp
 const searchIndex = [
 @if($role === 'manager')
 { label: 'Transaksi', desc: 'Daftar transaksi & POS', icon: 'point_of_sale', color: 'rgba(0,88,188,0.1)', textColor: 'text-primary', route: '{{ route("transactions") }}' },
 @endif
 @if(in_array($role, ['manager', 'supervisor']))
 { label: 'Produk', desc: 'Kelola data master produk', icon: 'category', color: 'rgba(0,110,40,0.1)', textColor: 'text-secondary', route: '{{ route("products.index") }}' },
 { label: 'Kategori', desc: 'Kelola kategori produk', icon: 'label', color: 'rgba(0,88,188,0.1)', textColor: 'text-primary', route: '{{ route("categories.index") }}' },
 @endif
 
 @if(in_array($role, ['warehouse', 'supervisor']))
 { label: 'Inventaris', desc: 'Cek stok & barang masuk', icon: 'inventory_2', color: 'rgba(158,61,0,0.1)', textColor: 'text-tertiary', route: '{{ route("inventory.index") }}' },
 { label: 'Pembelian', desc: 'Purchase Order / Inbound', icon: 'local_shipping',color: 'rgba(158,61,0,0.1)', textColor: 'text-tertiary', route: '{{ route("purchase-orders.index") }}' },
 { label: 'Stock Opname',desc: 'Penyesuaian stok gudang', icon: 'fact_check', color: 'rgba(186,26,26,0.1)', textColor: 'text-error', route: '{{ route("stock-opnames.index") }}' },
 @endif

 @if(in_array($role, ['owner', 'manager']))
 { label: 'Karyawan', desc: 'Manajemen SDM per cabang', icon: 'badge', color: 'rgba(0,88,188,0.08)', textColor: 'text-primary', route: '{{ route("employees") }}' },
 { label: 'Laporan', desc: 'Omzet, laba & performa cabang', icon: 'assessment', color: 'rgba(0,110,40,0.1)', textColor: 'text-secondary', route: '{{ route("reports.index") }}' },
 @endif

 @if(in_array($role, ['owner']))
 { label: 'Cabang', desc: '5 lokasi mini-market Jayusman', icon: 'store', color: 'rgba(0,110,40,0.1)', textColor: 'text-secondary', route: '{{ route("branches.index") }}' },
 { label: 'Audit Log', desc: 'Riwayat aktivitas sistem', icon: 'manage_history',color: 'rgba(186,26,26,0.1)', textColor: 'text-error', route: '{{ route("audit-log") }}' },
 { label: 'Pengaturan', desc: 'Konfigurasi akun & sistem', icon: 'settings', color: 'rgba(65,71,85,0.08)', textColor: 'text-on-surface-variant', route: '{{ route("settings") }}' },
 @endif
 ];

 function toggleSearch() {
 const dropdown = document.getElementById('search-dropdown');
 const isOpen = dropdown.classList.contains('open');

 if (isOpen) {
 closeSearch();
 } else {
 dropdown.classList.add('open');
 dropdown.setAttribute('aria-hidden', 'false');
 setTimeout(() => document.getElementById('search-input')?.focus(), 100);
 }
 }

 function closeSearch() {
 const dropdown = document.getElementById('search-dropdown');
 dropdown.classList.remove('open');
 dropdown.setAttribute('aria-hidden', 'true');
 clearSearch();
 }

 function clearSearch() {
 const input = document.getElementById('search-input');
 if (input) input.value = '';
 document.getElementById('search-clear').classList.add('hidden');
 document.getElementById('search-results').classList.add('hidden');
 document.getElementById('search-quick').classList.remove('hidden');
 }

 function handleSearch(query) {
 const clearBtn = document.getElementById('search-clear');
 const quickSection = document.getElementById('search-quick');
 const resultsSection = document.getElementById('search-results');
 const resultsList = document.getElementById('search-results-list');
 const emptyState = document.getElementById('search-empty');

 clearBtn.classList.toggle('hidden', query.length === 0);

 if (query.trim() === '') {
 quickSection.classList.remove('hidden');
 resultsSection.classList.add('hidden');
 return;
 }

 quickSection.classList.add('hidden');
 resultsSection.classList.remove('hidden');

 const filtered = searchIndex.filter(item =>
 item.label.toLowerCase().includes(query.toLowerCase()) ||
 item.desc.toLowerCase().includes(query.toLowerCase())
 );

 if (filtered.length === 0) {
 resultsList.innerHTML = '';
 emptyState.classList.remove('hidden');
 emptyState.classList.add('flex');
 } else {
 emptyState.classList.add('hidden');
 emptyState.classList.remove('flex');
 resultsList.innerHTML = filtered.map(item => `
 <a href="${item.route}" class="search-result-item flex items-center gap-3 px-5 py-3">
 <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
 style="background: ${item.color};">
 <span class="material-symbols-outlined text-[16px] ${item.textColor}"
 style="font-variation-settings:'FILL' 1;">${item.icon}</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">${item.label}</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant opacity-70">${item.desc}</p>
 </div>
 <span class="material-symbols-outlined text-[16px] text-on-surface-variant opacity-40 ml-auto">arrow_forward</span>
 </a>
 `).join('');
 }
 }

 /* Tutup saat klik di luar */
 document.addEventListener('click', function(e) {
 const wrapper = document.getElementById('search-wrapper');
 if (wrapper && !wrapper.contains(e.target)) closeSearch();
 });

 /* ESC key */
 document.addEventListener('keydown', function(e) {
 if (e.key === 'Escape') closeSearch();
 });
</script>
