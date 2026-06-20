@props(['name' => null, 'id' => null, 'required' => false, 'wrapperClass' => 'w-full'])

<div x-data="{
        open: false,
        internalValue: '',
        options: [],
        label: 'Pilih...',
        init() {
            const select = this.$refs.select;
            this.internalValue = select.value;
            this.updateOptions();
            
            // Sync jika <select> aslinya berubah (misal dari x-model luar)
            select.addEventListener('change', () => {
                this.internalValue = select.value;
                this.updateLabel();
            });

            // Observer jika option ditambah/dikurang (misal data dinamis)
            const observer = new MutationObserver(() => { 
                this.updateOptions(); 
                this.internalValue = select.value;
                this.updateLabel();
            });
            observer.observe(select, { childList: true, subtree: true });
        },
        updateOptions() {
            const select = this.$refs.select;
            this.options = Array.from(select.options).map(o => ({
                value: o.value,
                text: o.text,
                selected: o.selected
            }));
            this.updateLabel();
        },
        updateLabel() {
            const selected = this.options.find(o => o.value == this.internalValue);
            this.label = selected ? selected.text : (this.options.length > 0 ? this.options[0].text : 'Pilih...');
        },
        setValue(val) {
            this.internalValue = val;
            this.$refs.select.value = val;
            this.updateLabel();
            // Memicu event agar x-model atau event listener lain berjalan
            this.$refs.select.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.select.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }" 
    @click.away="open = false"
    class="relative inline-block {{ $wrapperClass }} min-w-[180px]">

    <!-- Original Hidden Select -->
    <select 
        x-ref="select"
        {{ $name ? 'name='.$name : '' }}
        {{ $id ? 'id='.$id : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'hidden']) }}
    >
        {{ $slot }}
    </select>

    <!-- Trigger Button (Glassmorphism) -->
    <button type="button" @click="open = !open"
        class="flex items-center justify-between w-full px-4 py-2.5 rounded-full outline-none focus:ring-2 focus:ring-primary/40 transition-all shadow-sm"
        style="background: rgba(255,255,255,0.35); backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); -webkit-backdrop-filter: blur(20px) saturate(1.8) brightness(1.05); border: 1px solid rgba(255,255,255,0.6);">
        <span x-text="label" class="font-body-md text-on-surface truncate text-left"></span>
        <span class="material-symbols-outlined text-on-surface-variant text-[18px] transition-transform duration-200" 
              :class="open ? 'rotate-180' : ''">expand_more</span>
    </button>

    <!-- Animated Dropdown Panel (Glassmorphism) -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
        class="absolute z-[60] w-full mt-2 rounded-[24px] overflow-hidden shadow-[0_24px_64px_rgba(0,0,0,0.08),inset_0_1px_1px_rgba(255,255,255,0.8)] origin-top"
        style="display: none; background: rgba(255,255,255,0.45); backdrop-filter: blur(32px) saturate(2) brightness(1.1); -webkit-backdrop-filter: blur(32px) saturate(2) brightness(1.1); border: 1px solid rgba(255, 255, 255, 0.7); max-height: 300px; overflow-y: auto;">
        
        <div class="flex flex-col p-2 gap-1">
            <template x-for="(opt, index) in options" :key="index">
                <button type="button" @click="setValue(opt.value); open = false;"
                    class="w-full text-left px-4 py-2.5 rounded-[16px] font-body-md transition-colors"
                    :class="internalValue == opt.value ? 'bg-white/60 text-primary font-semibold shadow-sm' : 'text-on-surface hover:bg-white/40'">
                    <span x-text="opt.text"></span>
                </button>
            </template>
        </div>
    </div>
</div>
