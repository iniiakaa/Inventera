<x-layouts.admin active="branches" title="Cabang - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Data Master</p>
 <h2 class="font-display text-display text-on-surface">Cabang</h2>
 </div>
 <a href="{{ route('branches.create') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all flex items-center space-x-2 w-fit">
 <span class="material-symbols-outlined text-[18px]">add_business</span>
 <span>Tambah Cabang</span>
 </a>
 </header>

 @if(session('success'))
 <div class="mb-6 p-4 rounded-xl bg-secondary-container text-on-secondary-container border border-secondary/20 flex items-center space-x-3">
 <span class="material-symbols-outlined">check_circle</span>
 <p class="font-body-md">{{ session('success') }}</p>
 </div>
 @endif

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="bg-surface-container-low border-b border-surface-variant">
 <th class="py-4 px-6 font-label-md text-on-surface-variant">Kode</th>
 <th class="py-4 px-6 font-label-md text-on-surface-variant">Nama Cabang</th>
 <th class="py-4 px-6 font-label-md text-on-surface-variant">Kota</th>
 <th class="py-4 px-6 font-label-md text-on-surface-variant">Manajer</th>
 <th class="py-4 px-6 font-label-md text-on-surface-variant">Status</th>
 <th class="py-4 px-6 font-label-md text-on-surface-variant text-right">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-surface-variant">
 @forelse($branches as $branch)
 <tr class="hover:bg-white/30 transition-colors">
 <td class="py-4 px-6 font-body-md text-on-surface">{{ $branch->code }}</td>
 <td class="py-4 px-6 font-body-md text-on-surface font-semibold">{{ $branch->name }}</td>
 <td class="py-4 px-6 font-body-md text-on-surface-variant">{{ $branch->city }}</td>
 <td class="py-4 px-6 font-body-md text-on-surface-variant">{{ $branch->manager_name ?? '-' }}</td>
 <td class="py-4 px-6">
 @if($branch->is_active)
 <span class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full font-label-sm text-xs">Aktif</span>
 @else
 <span class="px-3 py-1 bg-error-container text-on-error-container rounded-full font-label-sm text-xs">Nonaktif</span>
 @endif
 </td>
 <td class="py-4 px-6 flex items-center justify-end space-x-2">
 <a href="{{ route('branches.edit', $branch->id) }}" class="p-2 text-primary hover:bg-primary-container/50 rounded-lg transition-colors" title="Edit">
 <span class="material-symbols-outlined text-[20px]">edit</span>
 </a>
 <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan cabang ini?');" class="inline">
 @csrf
 @method('DELETE')
 <button type="submit" class="p-2 text-error hover:bg-error-container/50 rounded-lg transition-colors" title="Nonaktifkan" @if(!$branch->is_active) disabled style="opacity: 0.5" @endif>
 <span class="material-symbols-outlined text-[20px]">block</span>
 </button>
 </form>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="py-8 text-center text-on-surface-variant">
 <div class="flex flex-col items-center justify-center">
 <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">store_off</span>
 <p>Belum ada data cabang.</p>
 </div>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </section>
 
 <div class="pb-12"></div>
</x-layouts.admin>
