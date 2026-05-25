<x-pos-layout>
    <!-- Alpine.js POS State -->
    <div x-data="posCart()" class="flex gap-6 h-full overflow-hidden">

        <!-- ── Left: Product Catalog ── -->
        <div class="flex-1 flex flex-col gap-4 min-w-0 overflow-hidden">

            <!-- Search Bar -->
            <div class="liquid-glass rounded-2xl px-5 py-3 flex items-center gap-4 flex-shrink-0">
                <span class="material-symbols-outlined text-on-surface-variant text-[22px]">search</span>
                <input type="text" x-model="searchQuery"
                    placeholder="Cari nama produk atau SKU..."
                    class="flex-1 bg-transparent border-none outline-none text-on-surface placeholder:text-on-surface-variant/60 font-body-md text-body-md">
                <x-notif-dropdown />
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 content-start pr-1 pb-4">
                <template x-for="item in filteredProducts" :key="item.inventory_id">
                    <div @click="addToCart(item)"
                        class="liquid-glass rounded-2xl p-4 flex flex-col cursor-pointer hover:-translate-y-1 transition-transform duration-200 group h-fit">
                        <div class="w-full h-24 bg-white/30 rounded-xl mb-3 flex items-center justify-center border border-white/40">
                            <span class="material-symbols-outlined text-[36px] text-on-surface-variant/30 group-hover:scale-110 transition-transform">inventory_2</span>
                        </div>
                        <span class="font-label-sm text-label-sm text-on-surface-variant/70 mb-0.5" x-text="item.sku"></span>
                        <h4 class="font-label-md text-label-md text-on-surface leading-snug line-clamp-2 mb-2" x-text="item.name"></h4>
                        <div class="flex items-end justify-between">
                            <span class="font-headline-sm text-headline-sm text-primary" x-text="formatRupiah(item.price)"></span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant" x-text="'Stok: ' + item.stock"></span>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="filteredProducts.length === 0" class="col-span-full py-16 flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-[48px] text-on-surface-variant/30 mb-2">search_off</span>
                    <p class="font-body-md text-body-md text-on-surface-variant">Produk tidak ditemukan.</p>
                </div>
            </div>
        </div>

        <!-- ── Right: Cart ── -->
        <div class="w-[380px] xl:w-[420px] flex-shrink-0 flex flex-col h-full overflow-hidden">
            <div class="liquid-glass rounded-2xl flex flex-col h-full overflow-hidden border border-white/50">

                <!-- Cart Header -->
                <div class="px-5 py-4 border-b border-white/30 bg-white/10 flex items-center justify-between flex-shrink-0">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined">shopping_cart</span> Keranjang
                    </h3>
                    <button @click="clearCart" x-show="cart.length > 0"
                        class="font-label-sm text-label-sm text-error hover:underline transition-all">Bersihkan</button>
                </div>

                <!-- Cart Items -->
                <div class="flex-1 overflow-y-auto p-4 space-y-2">
                    <template x-for="(cartItem, index) in cart" :key="cartItem.inventory_id">
                        <div class="flex items-center gap-3 p-3 bg-white/20 hover:bg-white/30 rounded-xl transition-colors border border-white/20">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-label-md text-label-md text-on-surface truncate" x-text="cartItem.name"></h4>
                                <p class="font-body-sm text-body-sm text-primary" x-text="formatRupiah(cartItem.price)"></p>
                            </div>
                            <div class="flex items-center bg-white/40 rounded-full border border-white/50 px-1">
                                <button @click="decrementQty(index)" class="w-7 h-7 flex items-center justify-center text-on-surface hover:bg-white/50 rounded-full transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">remove</span>
                                </button>
                                <input type="number" x-model.number="cartItem.quantity" @change="validateQty(index)"
                                    class="w-8 text-center bg-transparent border-none font-label-md text-label-md p-0 focus:ring-0 text-on-surface [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button @click="incrementQty(index)" class="w-7 h-7 flex items-center justify-center text-on-surface hover:bg-white/50 rounded-full transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">add</span>
                                </button>
                            </div>
                            <div class="text-right ml-1 min-w-[72px]">
                                <p class="font-label-md text-label-md text-on-surface" x-text="formatRupiah(cartItem.price * cartItem.quantity)"></p>
                                <button @click="removeFromCart(index)" class="text-error/70 hover:text-error text-[11px] font-label-sm mt-0.5 transition-colors">Hapus</button>
                            </div>
                        </div>
                    </template>

                    <!-- Empty Cart -->
                    <div x-show="cart.length === 0" class="h-full flex flex-col items-center justify-center opacity-50 py-12 text-center">
                        <span class="material-symbols-outlined text-[56px] mb-3">shopping_bag</span>
                        <p class="font-body-lg text-body-lg text-on-surface">Keranjang kosong</p>
                        <p class="font-body-sm text-body-sm text-on-surface mt-1">Pilih produk dari katalog.</p>
                    </div>
                </div>

                <!-- Cart Footer -->
                <div class="bg-white/30 border-t border-white/40 p-5 backdrop-blur-md flex-shrink-0">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-body-md text-body-md text-on-surface-variant">Subtotal</span>
                        <span class="font-label-md text-label-md text-on-surface" x-text="formatRupiah(subtotal)"></span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-body-md text-body-md text-on-surface-variant">Pajak (0%)</span>
                        <span class="font-label-md text-label-md text-on-surface">Rp 0</span>
                    </div>
                    <hr class="border-white/30 mb-4">
                    <div class="flex justify-between items-end mb-5">
                        <span class="font-headline-sm text-headline-sm text-on-surface">Total</span>
                        <span class="font-display text-display text-primary" x-text="formatRupiah(total)"></span>
                    </div>
                    <button @click="openPaymentModal" :disabled="cart.length === 0"
                        :class="cart.length === 0 ? 'opacity-50 cursor-not-allowed bg-surface-variant text-on-surface-variant' : 'bg-primary text-on-primary hover:bg-primary/90 shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:-translate-y-1'"
                        class="w-full py-3.5 rounded-full font-label-lg text-label-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">payments</span> Proses Pembayaran
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Payment Modal (via Alpine teleport ke body) ── -->
        <template x-teleport="body">
            <div x-show="isPaymentModalOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                style="display:none;"
                class="fixed inset-0 z-[200] flex items-center justify-center p-6">

                <!-- Backdrop -->
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="isPaymentModalOpen = false"></div>

                <!-- Modal Card -->
                <div class="relative z-10 w-full max-w-[460px] rounded-[28px] overflow-hidden shadow-[0_24px_64px_rgba(0,0,0,0.15)] border border-white/40 flex flex-col"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100">

                    <!-- Bagian Metode Pembayaran: Hitam transparan blur 11px -->
                    <div class="bg-black/10 backdrop-blur-[11px] p-8 pb-6">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Pilih Metode Pembayaran</h2>
                            <button @click="isPaymentModalOpen = false"
                                class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-black/5 text-on-surface-variant transition-colors">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                            </button>
                        </div>

                        <!-- Total Tagihan -->
                        <div class="text-center mb-6">
                            <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Total Tagihan</p>
                            <p class="text-[38px] font-bold text-primary leading-none" x-text="formatRupiah(total)"></p>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <button @click="paymentMethod = 'cash'"
                                :class="paymentMethod === 'cash' ? 'bg-primary/5 border-primary ring-1 ring-primary shadow-sm' : 'bg-black/5 border-black/10 hover:bg-primary/5 hover:border-primary/50 hover:ring-1 hover:ring-primary/30'"
                                class="group flex flex-col items-center justify-center py-4 rounded-2xl border transition-all">
                                <span class="material-symbols-outlined text-[26px] mb-1.5 transition-colors" :class="paymentMethod === 'cash' ? 'text-primary' : 'text-on-surface group-hover:text-primary'">payments</span>
                                <span class="font-label-sm text-label-sm text-on-surface" :class="paymentMethod === 'cash' ? 'font-bold' : ''">Tunai</span>
                            </button>
                            <button @click="paymentMethod = 'qris'; amountPaid = total"
                                :class="paymentMethod === 'qris' ? 'bg-primary/5 border-primary ring-1 ring-primary shadow-sm' : 'bg-black/5 border-black/10 hover:bg-primary/5 hover:border-primary/50 hover:ring-1 hover:ring-primary/30'"
                                class="group flex flex-col items-center justify-center py-4 rounded-2xl border transition-all">
                                <span class="material-symbols-outlined text-[26px] mb-1.5 transition-colors" :class="paymentMethod === 'qris' ? 'text-primary' : 'text-on-surface group-hover:text-primary'">qr_code_2</span>
                                <span class="font-label-sm text-label-sm text-on-surface" :class="paymentMethod === 'qris' ? 'font-bold' : ''">QRIS</span>
                            </button>
                            <button @click="paymentMethod = 'card'; amountPaid = total"
                                :class="paymentMethod === 'card' ? 'bg-primary/5 border-primary ring-1 ring-primary shadow-sm' : 'bg-black/5 border-black/10 hover:bg-primary/5 hover:border-primary/50 hover:ring-1 hover:ring-primary/30'"
                                class="group flex flex-col items-center justify-center py-4 rounded-2xl border transition-all">
                                <span class="material-symbols-outlined text-[26px] mb-1.5 transition-colors" :class="paymentMethod === 'card' ? 'text-primary' : 'text-on-surface group-hover:text-primary'">credit_card</span>
                                <span class="font-label-sm text-label-sm text-on-surface" :class="paymentMethod === 'card' ? 'font-bold' : ''">Kartu</span>
                            </button>
                        </div>

                        <!-- Input Nominal (hanya untuk Tunai) -->
                        <div x-show="paymentMethod === 'cash'" x-transition class="mb-2">
                            <p class="font-label-sm text-label-sm text-on-surface-variant mb-2">Nominal Bayar</p>
                            <div class="relative mb-3 group">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 font-label-md text-on-surface-variant group-hover:text-primary transition-colors">Rp</span>
                                <input type="number" x-model.number="amountPaid"
                                    class="w-full bg-black/5 hover:bg-primary/5 border border-black/10 hover:border-primary/50 rounded-full py-3 pl-14 pr-5 text-on-surface text-lg font-bold focus:outline-none focus:ring-2 focus:ring-primary/40 focus:bg-primary/5 transition-all">
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <button @click="amountPaid = total" class="bg-black/5 hover:bg-primary/10 hover:text-primary rounded-full py-2 font-label-sm text-label-sm text-on-surface transition-colors font-medium border border-transparent hover:border-primary/20">Pas</button>
                                <button @click="amountPaid = Math.ceil(total / 50000) * 50000" class="bg-black/5 hover:bg-primary/10 hover:text-primary rounded-full py-2 font-label-sm text-label-sm text-on-surface transition-colors font-medium border border-transparent hover:border-primary/20" x-text="formatRupiah(Math.ceil(total / 50000) * 50000)"></button>
                                <button @click="amountPaid = Math.ceil(total / 100000) * 100000" class="bg-primary/10 hover:bg-primary/20 text-primary rounded-full py-2 font-label-sm text-label-sm transition-colors font-bold border border-primary/30" x-text="formatRupiah(Math.ceil(total / 100000) * 100000)"></button>
                            </div>
                        </div>
                    </div>

                    <!-- Garis Pemisah -->
                    <div class="h-[1px] bg-white/30 w-full z-20"></div>

                    <!-- Bagian Summary: Putih transparan blur 11px -->
                    <div class="bg-white/20 backdrop-blur-[11px] p-8 pt-6">
                        <!-- Summary -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-sm text-label-sm text-on-surface-variant">Total Bayar</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold" x-text="formatRupiah(amountPaid)"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-headline-sm text-headline-sm font-bold" :class="changeAmount >= 0 ? 'text-[#16a34a]' : 'text-error'">Kembalian</span>
                                <span class="font-headline-sm text-headline-sm font-bold" :class="changeAmount >= 0 ? 'text-[#16a34a]' : 'text-error'"
                                    x-text="changeAmount >= 0 ? formatRupiah(changeAmount) : 'Kurang ' + formatRupiah(Math.abs(changeAmount))"></span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-3">
                            <button @click="isPaymentModalOpen = false"
                                class="px-5 py-3.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:bg-black/5 transition-colors">
                                Batal
                            </button>
                            <button @click="submitCheckout" :disabled="isProcessing || changeAmount < 0"
                                :class="(isProcessing || changeAmount < 0) ? 'opacity-50 cursor-not-allowed bg-surface-variant text-on-surface-variant' : 'bg-primary text-on-primary hover:bg-primary/90 shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:-translate-y-0.5'"
                                class="flex-1 py-3.5 rounded-full font-label-md text-label-md font-bold transition-all duration-300 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]" x-show="!isProcessing">print</span>
                                <svg x-show="isProcessing" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="isProcessing ? 'Memproses...' : 'Konfirmasi & Cetak Struk'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Inject Data -->
    <script>
        const INVENTORY_DATA = @json($inventoryData);

        function posCart() {
            return {
                products: INVENTORY_DATA,
                searchQuery: '',
                activeCategory: 'all',
                cart: [],
                isPaymentModalOpen: false,
                amountPaid: 0,
                isProcessing: false,
                paymentMethod: 'cash',

                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchSearch = p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            p.sku.toLowerCase().includes(this.searchQuery.toLowerCase());
                        const matchCat = this.activeCategory === 'all' || p.category_id == this.activeCategory;
                        return matchSearch && matchCat;
                    });
                },

                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                get total() {
                    return this.subtotal;
                },

                get changeAmount() {
                    return this.amountPaid - this.total;
                },

                addToCart(product) {
                    const existingIndex = this.cart.findIndex(i => i.inventory_id === product.inventory_id);
                    if (existingIndex > -1) {
                        if (this.cart[existingIndex].quantity < product.stock) {
                            this.cart[existingIndex].quantity++;
                        } else {
                            alert('Stok tidak mencukupi!');
                        }
                    } else {
                        if (product.stock > 0) {
                            this.cart.unshift({ ...product, quantity: 1 });
                        }
                    }
                },

                incrementQty(index) {
                    const item = this.cart[index];
                    const invItem = this.products.find(p => p.inventory_id === item.inventory_id);
                    if (item.quantity < invItem.stock) {
                        item.quantity++;
                    } else {
                        alert('Stok maksimal tercapai!');
                    }
                },

                decrementQty(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    } else {
                        this.removeFromCart(index);
                    }
                },

                validateQty(index) {
                    const item = this.cart[index];
                    const invItem = this.products.find(p => p.inventory_id === item.inventory_id);
                    if (item.quantity > invItem.stock) {
                        item.quantity = invItem.stock;
                        alert('Kuantitas melebihi stok. Diatur ke maksimum.');
                    }
                    if (item.quantity < 1) item.quantity = 1;
                },

                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },

                clearCart() {
                    if (confirm('Bersihkan keranjang?')) {
                        this.cart = [];
                    }
                },

                openPaymentModal() {
                    if (this.cart.length === 0) return;
                    this.amountPaid = 0;
                    this.paymentMethod = 'cash';
                    this.isPaymentModalOpen = true;
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
                },

                async submitCheckout() {
                    if (this.changeAmount < 0) return;
                    this.isProcessing = true;
                    try {
                        const response = await fetch('{{ route("pos.checkout") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                cart: this.cart,
                                amount_paid: this.amountPaid,
                                payment_method: this.paymentMethod
                            })
                        });
                        const data = await response.json();
                        if (data.success) {
                            alert('Transaksi Berhasil!\nNo. Invoice: ' + data.transaction.invoice_number);
                            window.location.reload();
                        } else {
                            alert('Gagal: ' + data.message);
                            this.isProcessing = false;
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan jaringan.');
                        this.isProcessing = false;
                    }
                }
            }
        }
    </script>
</x-pos-layout>