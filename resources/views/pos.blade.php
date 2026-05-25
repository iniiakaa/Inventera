<x-liquid-layout>
    <x-slot name="title">Point of Sale (POS)</x-slot>

    <!-- State Alpine.js untuk POS -->
    <div x-data="posCart()" class="flex flex-col lg:flex-row gap-6 h-full min-h-[80vh]">
        
        <!-- Left Area: Catalog -->
        <div class="flex-1 flex flex-col space-y-4">
            <!-- Search & Filter -->
            <div class="liquid-glass p-4 rounded-xl flex items-center justify-between gap-4">
                <div class="relative flex-1">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input type="text" x-model="searchQuery" placeholder="Cari nama produk atau SKU..." class="w-full bg-white/20 border border-white/40 rounded-full py-2.5 pl-10 pr-4 text-on-surface placeholder:text-on-surface-variant/70 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-body-md text-body-md">
                </div>
                
                <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar pb-2 lg:pb-0">
                    <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-primary text-on-primary' : 'bg-white/20 text-on-surface hover:bg-white/40'" class="px-4 py-2 rounded-full whitespace-nowrap font-label-md text-label-md transition-all border border-white/40">Semua</button>
                    @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->id }}'" :class="activeCategory == '{{ $category->id }}' ? 'bg-primary text-on-primary' : 'bg-white/20 text-on-surface hover:bg-white/40'" class="px-4 py-2 rounded-full whitespace-nowrap font-label-md text-label-md transition-all border border-white/40">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto pr-2 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 pb-12">
                <template x-for="item in filteredProducts" :key="item.inventory_id">
                    <div @click="addToCart(item)" class="liquid-glass rounded-xl p-4 flex flex-col cursor-pointer hover:-translate-y-1 transition-transform duration-200 group">
                        <div class="w-full h-28 bg-white/30 rounded-lg mb-3 flex items-center justify-center overflow-hidden border border-white/40">
                            <!-- Placeholder image, later replace with item.image -->
                            <span class="material-symbols-outlined text-[40px] text-on-surface-variant/30 group-hover:scale-110 transition-transform">inventory_2</span>
                        </div>
                        <div class="flex-1 flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-surface-variant/70 mb-1" x-text="item.sku"></span>
                            <h4 class="font-label-md text-label-md text-on-surface leading-snug line-clamp-2 flex-1" x-text="item.name"></h4>
                            <div class="flex items-end justify-between mt-2">
                                <span class="font-headline-sm text-headline-sm text-primary" x-text="formatRupiah(item.price)"></span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant" x-text="'Stok: ' + item.stock"></span>
                            </div>
                        </div>
                    </div>
                </template>
                <!-- Empty state -->
                <div x-show="filteredProducts.length === 0" class="col-span-full py-12 flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-[48px] text-on-surface-variant/30 mb-2">search_off</span>
                    <p class="font-body-md text-body-md text-on-surface-variant">Produk tidak ditemukan.</p>
                </div>
            </div>
        </div>

        <!-- Right Area: Cart -->
        <div class="w-full lg:w-[400px] xl:w-[450px] flex-shrink-0 flex flex-col h-[calc(100vh-140px)] sticky top-[80px]">
            <div class="liquid-glass rounded-2xl flex flex-col h-full overflow-hidden border border-white/50 shadow-lg">
                <!-- Cart Header -->
                <div class="p-5 border-b border-white/30 bg-white/10 flex items-center justify-between">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined">shopping_cart</span> Keranjang
                    </h3>
                    <button @click="clearCart" x-show="cart.length > 0" class="font-label-sm text-label-sm text-error hover:underline transition-all">Bersihkan</button>
                </div>

                <!-- Cart Items -->
                <div class="flex-1 overflow-y-auto p-2">
                    <template x-for="(cartItem, index) in cart" :key="cartItem.inventory_id">
                        <div class="flex items-center gap-3 p-3 bg-white/20 hover:bg-white/30 rounded-xl mb-2 transition-colors border border-white/20">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-label-md text-label-md text-on-surface truncate" x-text="cartItem.name"></h4>
                                <p class="font-body-sm text-body-sm text-primary" x-text="formatRupiah(cartItem.price)"></p>
                            </div>
                            
                            <!-- Qty Control -->
                            <div class="flex items-center bg-white/40 rounded-full border border-white/50 px-1">
                                <button @click="decrementQty(index)" class="w-7 h-7 flex items-center justify-center text-on-surface hover:bg-white/50 rounded-full transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">remove</span>
                                </button>
                                <input type="number" x-model.number="cartItem.quantity" @change="validateQty(index)" class="w-8 text-center bg-transparent border-none font-label-md text-label-md p-0 focus:ring-0 text-on-surface [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button @click="incrementQty(index)" class="w-7 h-7 flex items-center justify-center text-on-surface hover:bg-white/50 rounded-full transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">add</span>
                                </button>
                            </div>
                            
                            <!-- Subtotal & Remove -->
                            <div class="text-right ml-2 min-w-[80px]">
                                <p class="font-label-md text-label-md text-on-surface" x-text="formatRupiah(cartItem.price * cartItem.quantity)"></p>
                                <button @click="removeFromCart(index)" class="text-error/70 hover:text-error text-[12px] font-label-sm mt-1 transition-colors">Hapus</button>
                            </div>
                        </div>
                    </template>
                    
                    <div x-show="cart.length === 0" class="h-full flex flex-col items-center justify-center opacity-50 p-6 text-center">
                        <span class="material-symbols-outlined text-[64px] mb-4">shopping_bag</span>
                        <p class="font-body-lg text-body-lg text-on-surface">Keranjang kosong</p>
                        <p class="font-body-sm text-body-sm text-on-surface mt-1">Pilih produk dari katalog di sebelah kiri.</p>
                    </div>
                </div>

                <!-- Cart Footer (Checkout) -->
                <div class="bg-white/30 border-t border-white/40 p-5 backdrop-blur-md">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-body-md text-body-md text-on-surface-variant">Subtotal</span>
                        <span class="font-label-lg text-label-lg text-on-surface" x-text="formatRupiah(subtotal)"></span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-body-md text-body-md text-on-surface-variant">Pajak (0%)</span>
                        <span class="font-label-lg text-label-lg text-on-surface">Rp 0</span>
                    </div>
                    
                    <hr class="border-white/30 mb-4">
                    
                    <div class="flex justify-between items-end mb-6">
                        <span class="font-headline-sm text-headline-sm text-on-surface">Total</span>
                        <span class="font-display text-display text-primary" x-text="formatRupiah(total)"></span>
                    </div>

                    <button @click="openPaymentModal" :disabled="cart.length === 0" :class="cart.length === 0 ? 'opacity-50 cursor-not-allowed bg-surface-variant text-on-surface-variant' : 'bg-primary text-on-primary hover:bg-primary/90 shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:-translate-y-1'" class="w-full py-4 rounded-full font-label-lg text-label-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">payments</span> Proses Pembayaran
                    </button>
                </div>
            </div>
        </div>

        <!-- Payment Modal -->
        <div x-show="isPaymentModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" @click="isPaymentModalOpen = false"></div>
            
            <div class="liquid-glass rounded-[24px] p-8 w-full max-w-md relative z-10 scale-100 transition-transform">
                <button @click="isPaymentModalOpen = false" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
                
                <h2 class="font-headline-md text-headline-md text-on-surface mb-6">Pembayaran</h2>
                
                <div class="bg-primary-container/30 rounded-xl p-4 mb-6 border border-primary/20 text-center">
                    <p class="font-body-md text-body-md text-on-surface-variant mb-1">Total Tagihan</p>
                    <p class="font-display text-display text-primary" x-text="formatRupiah(total)"></p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Uang Diterima (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-label-lg text-on-surface-variant">Rp</span>
                            <input type="number" x-model.number="amountPaid" class="w-full bg-white/50 border border-white/60 rounded-xl py-3 pl-12 pr-4 text-on-surface text-lg font-bold focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                        </div>
                    </div>

                    <!-- Quick Cash Buttons -->
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="amountPaid = total" class="bg-white/30 hover:bg-white/50 rounded-lg py-2 font-label-md text-label-md transition-colors border border-white/40">Uang Pas</button>
                        <button @click="amountPaid = Math.ceil(total / 50000) * 50000" class="bg-white/30 hover:bg-white/50 rounded-lg py-2 font-label-md text-label-md transition-colors border border-white/40" x-text="formatRupiah(Math.ceil(total / 50000) * 50000)"></button>
                        <button @click="amountPaid = Math.ceil(total / 100000) * 100000" class="bg-white/30 hover:bg-white/50 rounded-lg py-2 font-label-md text-label-md transition-colors border border-white/40" x-text="formatRupiah(Math.ceil(total / 100000) * 100000)"></button>
                    </div>

                    <div class="bg-secondary-container/20 rounded-xl p-4 border border-secondary/20 mt-4 flex justify-between items-center" :class="changeAmount >= 0 ? 'bg-secondary-container/20' : 'bg-error-container/20 border-error/20'">
                        <span class="font-body-md text-body-md text-on-surface-variant">Kembalian</span>
                        <span class="font-headline-md text-headline-md" :class="changeAmount >= 0 ? 'text-secondary' : 'text-error'" x-text="changeAmount >= 0 ? formatRupiah(changeAmount) : 'Kurang ' + formatRupiah(Math.abs(changeAmount))"></span>
                    </div>
                </div>

                <div class="mt-8">
                    <button @click="submitCheckout" :disabled="isProcessing || changeAmount < 0" :class="(isProcessing || changeAmount < 0) ? 'opacity-50 cursor-not-allowed bg-surface-variant text-on-surface-variant' : 'bg-primary text-on-primary hover:bg-primary/90 shadow-[0_8px_16px_rgba(0,88,188,0.3)]'" class="w-full py-3.5 rounded-full font-label-lg text-label-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" x-show="!isProcessing">check_circle</span>
                        <svg x-show="isProcessing" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isProcessing ? 'Memproses...' : 'Selesaikan Transaksi'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inject Data Inventori ke Javascript -->
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
                    return this.subtotal; // Jika ada pajak/diskon, hitung di sini
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
                        alert('Kuantitas melebihi stok yang tersedia. Diatur ke maksimum stok.');
                    }
                    if (item.quantity < 1) item.quantity = 1;
                },

                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },

                clearCart() {
                    if(confirm('Bersihkan keranjang?')) {
                        this.cart = [];
                    }
                },

                openPaymentModal() {
                    if (this.cart.length === 0) return;
                    this.amountPaid = 0;
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
                            alert('Transaksi Berhasil! \nNo. Invoice: ' + data.transaction.invoice_number);
                            // Refresh halaman untuk mereset state dan memperbarui stok
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
</x-liquid-layout>
