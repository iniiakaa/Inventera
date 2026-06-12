<x-layouts.admin active="branches" title="Edit Cabang - Inventera">
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 mt-8 md:mt-0">
        <div class="flex items-center space-x-4">
            <a href="{{ route('branches.index') }}" class="p-2 bg-surface-container hover:bg-surface-variant text-on-surface rounded-full transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-1">Data Master / Cabang</p>
                <h2 class="font-display text-headline-lg text-on-surface">Edit Cabang</h2>
            </div>
        </div>
    </header>

    <section class="liquid-glass rounded-xl p-8 max-w-3xl">
        <form action="{{ route('branches.update', $branch->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kode Cabang -->
                <div>
                    <label for="code" class="block font-label-md text-on-surface mb-2">Kode Cabang <span class="text-error">*</span></label>
                    <input type="text" id="code" name="code" value="{{ old('code', $branch->code) }}" required
                           class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">
                    @error('code')
                        <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Cabang -->
                <div>
                    <label for="name" class="block font-label-md text-on-surface mb-2">Nama Cabang <span class="text-error">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $branch->name) }}" required
                           class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">
                    @error('name')
                        <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kota -->
                <div>
                    <label for="city" class="block font-label-md text-on-surface mb-2">Kota <span class="text-error">*</span></label>
                    <input type="text" id="city" name="city" value="{{ old('city', $branch->city) }}" required
                           class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">
                    @error('city')
                        <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Manajer -->
                <div>
                    <label for="manager_name" class="block font-label-md text-on-surface mb-2">Nama Manajer</label>
                    <input type="text" id="manager_name" name="manager_name" value="{{ old('manager_name', $branch->manager_name) }}"
                           class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">
                    @error('manager_name')
                        <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="phone" class="block font-label-md text-on-surface mb-2">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $branch->phone) }}"
                           class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">
                    @error('phone')
                        <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center mt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $branch->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ml-3 font-label-md text-on-surface">Cabang Aktif</span>
                    </label>
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div>
                <label for="address" class="block font-label-md text-on-surface mb-2">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="3"
                          class="w-full bg-surface/50 border border-outline-variant focus:border-primary focus:ring focus:ring-primary/20 rounded-lg px-4 py-2.5 text-on-surface transition-all placeholder:text-on-surface-variant/50">{{ old('address', $branch->address) }}</textarea>
                @error('address')
                    <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-outline-variant/30 space-x-4">
                <a href="{{ route('branches.index') }}" class="px-5 py-2.5 bg-surface-container hover:bg-surface-variant text-on-surface rounded-full font-label-md transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-primary hover:opacity-90 text-on-primary rounded-full font-label-md shadow-[0_4px_12px_rgba(0,88,188,0.25)] transition-all flex items-center space-x-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </section>

</x-layouts.admin>
