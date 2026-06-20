@props(['notifications' => []])

<div class="relative" id="notif-wrapper">

 <!-- Bell Button -->
 <button id="notif-btn" onclick="toggleNotif()"
 class="relative w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant transition-all duration-200 hover:text-on-surface"
 style="background: rgba(255,255,255,0.25); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);"
 aria-label="Notifikasi">
 <span class="material-symbols-outlined text-[20px]">notifications</span>
 <!-- Unread dot -->
 <span id="notif-dot"
 class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-error rounded-full border-2 border-surface animate-pulse"></span>
 </button>

 <!-- Dropdown Panel -->
 <div id="notif-dropdown" class="notif-dropdown absolute right-0 mt-3 w-[360px] z-50 origin-top-right rounded-[24px]"
 aria-hidden="true">

 <!-- Header -->
 <div class="flex items-center justify-between px-5 py-4"
 style="border-bottom: 1px solid rgba(255,255,255,0.3);">
 <div>
 <h3 class="font-headline-md text-headline-md text-on-surface font-bold">Notifikasi</h3>
 <p class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">3 belum dibaca</p>
 </div>
 <button class="font-label-sm text-label-sm text-primary hover:opacity-70 transition-opacity">
 Tandai semua dibaca
 </button>
 </div>

 <!-- List -->
 <ul class="divide-y max-h-[400px] overflow-y-auto" style="divide-color: rgba(255,255,255,0.3);">

 <!-- Item: Stok Kritis -->
 <li class="notif-item flex items-start gap-3 px-5 py-4 relative">
 <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
 style="background: rgba(186,26,26,0.1);">
 <span class="material-symbols-outlined text-[18px] text-error"
 style="font-variation-settings:'FILL' 1;">warning</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface">Stok Indomie Goreng Kritis</p>
 <p class="font-body-md text-body-md text-on-surface-variant text-[13px] mt-0.5 leading-snug">
 Cabang Surabaya — sisa 4 pcs, di bawah minimum stok (10 pcs)</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/60 mt-1.5">5 menit lalu</p>
 </div>
 <span class="w-2 h-2 rounded-full bg-error flex-shrink-0 mt-2"></span>
 </li>

 <!-- Item: Transaksi Void -->
 <li class="notif-item flex items-start gap-3 px-5 py-4 relative">
 <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
 style="background: rgba(158,61,0,0.1);">
 <span class="material-symbols-outlined text-[18px] text-tertiary"
 style="font-variation-settings:'FILL' 1;">receipt_long</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface">Permintaan Void Transaksi</p>
 <p class="font-body-md text-body-md text-on-surface-variant text-[13px] mt-0.5 leading-snug">
 Kasir Jaya — Cabang Jakarta meminta pembatalan Inv #JKT-20260519-042</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/60 mt-1.5">23 menit lalu</p>
 </div>
 <span class="w-2 h-2 rounded-full bg-tertiary flex-shrink-0 mt-2"></span>
 </li>

 <!-- Item: Laporan siap -->
 <li class="notif-item flex items-start gap-3 px-5 py-4 relative">
 <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
 style="background: rgba(0,110,40,0.1);">
 <span class="material-symbols-outlined text-[18px] text-secondary"
 style="font-variation-settings:'FILL' 1;">task_alt</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface">Laporan Bulanan Siap</p>
 <p class="font-body-md text-body-md text-on-surface-variant text-[13px] mt-0.5 leading-snug">
 Laporan Mei 2026 untuk semua cabang telah selesai dibuat.</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/60 mt-1.5">1 jam lalu</p>
 </div>
 <span class="w-2 h-2 rounded-full bg-secondary flex-shrink-0 mt-2"></span>
 </li>

 <!-- Item: sudah dibaca -->
 <li class="notif-item flex items-start gap-3 px-5 py-4 opacity-60">
 <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
 style="background: rgba(65,71,85,0.08);">
 <span class="material-symbols-outlined text-[18px] text-on-surface-variant"
 style="font-variation-settings:'FILL' 1;">person_add</span>
 </div>
 <div class="flex-1 min-w-0">
 <p class="font-label-md text-label-md text-on-surface">Karyawan Baru Ditambahkan</p>
 <p class="font-body-md text-body-md text-on-surface-variant text-[13px] mt-0.5 leading-snug">
 Ahmad Fauzi menambahkan Rina Sari sebagai Kasir di Cabang Bandung.</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant/60 mt-1.5">3 jam lalu</p>
 </div>
 </li>

 </ul>

 <!-- Footer -->
 <div class="px-5 py-3.5" style="border-top: 1px solid rgba(255,255,255,0.3);">
 <a href="#"
 class="flex items-center justify-center gap-1.5 font-label-md text-label-md text-primary hover:opacity-70 transition-opacity">
 <span>Lihat semua notifikasi</span>
 <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
 </a>
 </div>

 </div>
</div>

<style>
 /* ═══════════════════════════════════════════
 Gaussian Blur — Apple Frosted Glass Style
 backdrop-filter langsung di container,
 overflow: clip (bukan hidden!) agar blur
 tidak terblokir tapi konten tetap terpotong
 ═══════════════════════════════════════════ */
 #notif-dropdown {
 /* Warna fill sangat transparan — biarkan blur yang bicara */
 background: rgba(235, 240, 255, 0.38);

 /* Gaussian blur maksimum */
 backdrop-filter:
 blur(8px) saturate(1.8) brightness(1.06) contrast(0.96);
 -webkit-backdrop-filter:
 blur(8px) saturate(1.8) brightness(1.06) contrast(0.96);

 border: 1px solid rgba(255, 255, 255, 0.72);

 box-shadow:
 /* Soft ambient */
 0 8px 32px rgba(0, 0, 0, 0.07),
 0 40px 80px rgba(0, 0, 0, 0.09),
 /* Light refraction edge (top) */
 inset 0 1.5px 0 rgba(255, 255, 255, 0.92),
 /* Depth edge (bottom) */
 inset 0 -1px 0 rgba(0, 0, 0, 0.05);

 /* overflow:clip memotong konten seperti hidden
 tapi TIDAK membuat stacking context baru
 sehingga backdrop-filter tetap bekerja */
 overflow: clip;
 }

 /* Shimmer gradient overlay — simulasi permukaan kaca */
 #notif-dropdown::before {
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

 /* Konten di atas shimmer */
 #notif-dropdown>* {
 position: relative;
 z-index: 1;
 }

 /* ── Animasi Dropdown ── */
 .notif-dropdown {
 pointer-events: none;
 opacity: 0;
 transform: scale(0.92) translateY(-8px);
 transform-origin: top right;
 transition:
 opacity 0.28s cubic-bezier(0.32, 0.72, 0, 1),
 transform 0.28s cubic-bezier(0.32, 0.72, 0, 1);
 will-change: transform, opacity;
 }

 .notif-dropdown.open {
 pointer-events: auto;
 opacity: 1;
 transform: scale(1) translateY(0);
 }

 /* Notif item hover & animation */
 .notif-item {
 cursor: pointer;
 transition: background 0.18s ease;
 }

 .notif-item:hover {
 background: rgba(255, 255, 255, 0.3);
 }

 @keyframes fadeInUpItem {
 from {
 opacity: 0;
 transform: translateY(15px);
 }
 to {
 transform: translateY(0);
 }
 }

 .notif-dropdown.open .notif-item {
 animation: fadeInUpItem 0.4s cubic-bezier(0.32, 0.72, 0, 1) both;
 }
 
 .notif-dropdown.open .notif-item:nth-child(1) { animation-delay: 0.10s; }
 .notif-dropdown.open .notif-item:nth-child(2) { animation-delay: 0.15s; }
 .notif-dropdown.open .notif-item:nth-child(3) { animation-delay: 0.20s; }
 .notif-dropdown.open .notif-item:nth-child(4) { animation-delay: 0.25s; }
 .notif-dropdown.open .notif-item:nth-child(5) { animation-delay: 0.30s; }

 /* Scrollbar dalam dropdown */
 #notif-dropdown ::-webkit-scrollbar {
 width: 4px;
 }

 #notif-dropdown ::-webkit-scrollbar-track {
 background: transparent;
 }

 #notif-dropdown ::-webkit-scrollbar-thumb {
 background: rgba(0, 88, 188, 0.2);
 border-radius: 9999px;
 }
</style>

<script>
 function toggleNotif() {
 const dropdown = document.getElementById('notif-dropdown');
 const dot = document.getElementById('notif-dot');
 const isOpen = dropdown.classList.contains('open');

 if (isOpen) {
 dropdown.classList.remove('open');
 dropdown.setAttribute('aria-hidden', 'true');
 } else {
 dropdown.classList.add('open');
 dropdown.setAttribute('aria-hidden', 'false');
 // Hilangkan dot setelah dibuka
 if (dot) {
 dot.style.transition = 'opacity 0.3s ease';
 dot.style.opacity = '0';
 setTimeout(() => dot.remove(), 300);
 }
 }
 }

 // Tutup saat klik di luar
 document.addEventListener('click', function (e) {
 const wrapper = document.getElementById('notif-wrapper');
 if (wrapper && !wrapper.contains(e.target)) {
 const dropdown = document.getElementById('notif-dropdown');
 if (dropdown) {
 dropdown.classList.remove('open');
 dropdown.setAttribute('aria-hidden', 'true');
 }
 }
 });
</script>