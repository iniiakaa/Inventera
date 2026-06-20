<x-layouts.admin active="activity-logs" title="Activity Logs - Inventera">
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Audit & Keamanan</p>
 <h2 class="font-display text-display text-on-surface">Activity Logs</h2>
 <p class="text-sm text-gray-500 mt-1">Rekam jejak aktivitas penting seluruh sistem.</p>
 </div>
 </header>

 <!-- Filter -->
 <div class="mb-6 flex">
 <form action="{{ route('activity-logs.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..."
 class="px-4 py-2 rounded-lg border border-gray-300 font-body-md bg-white focus:ring-primary focus:border-primary w-full md:w-64">
 <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 font-label-md transition-colors flex items-center gap-1">
 <span class="material-symbols-outlined text-[18px]">search</span> Cari
 </button>
 @if(request('search'))
 <a href="{{ route('activity-logs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 font-label-md transition-colors flex items-center">Reset</a>
 @endif
 </form>
 </div>

 <section class="liquid-glass rounded-xl overflow-hidden shadow-sm border border-gray-100">
 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-gray-200 bg-gray-50/50">
 <th class="p-4 font-label-md text-gray-600">Waktu</th>
 <th class="p-4 font-label-md text-gray-600">Aktor (Causer)</th>
 <th class="p-4 font-label-md text-gray-600">Modul (Log Name)</th>
 <th class="p-4 font-label-md text-gray-600">Deskripsi Aktivitas</th>
 <th class="p-4 font-label-md text-gray-600">Properti Detail</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-gray-100 font-body-md text-gray-800">
 @forelse($logs as $log)
 <tr class="hover:bg-gray-50/50 transition-colors">
 <td class="p-4 whitespace-nowrap text-gray-600">
 {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }}
 </td>
 <td class="p-4">
 <span class="font-medium text-primary">{{ $log->causer->name ?? 'System/Guest' }}</span>
 <span class="text-xs text-gray-500 block">ID: {{ $log->causer_id ?? '-' }}</span>
 </td>
 <td class="p-4">
 <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700">{{ $log->log_name }}</span>
 </td>
 <td class="p-4 font-medium">{{ $log->description }}</td>
 <td class="p-4 text-xs text-gray-500">
 @if(!empty($log->properties))
 <details class="cursor-pointer">
 <summary class="text-primary hover:underline">Lihat JSON</summary>
 <pre class="mt-2 p-2 bg-gray-50 rounded border border-gray-200 overflow-x-auto text-[10px]">{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</pre>
 </details>
 @else
 -
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="p-12 text-center text-gray-400 font-body-md">
 Belum ada catatan log aktivitas.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 
 @if($logs->hasPages())
 <div class="p-4 border-t border-gray-100 bg-white">
 {{ $logs->withQueryString()->links() }}
 </div>
 @endif
 </section>
</x-layouts.admin>
