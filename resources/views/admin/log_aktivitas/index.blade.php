<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Log Aktivitas Admin</h1>
    </x-slot>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 text-sm">Riwayat Aktivitas</h3>
            <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">{{ $logs->count() }} aktivitas</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50/80 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-48">Waktu</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-48">Admin</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aktivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="px-5 py-3.5 font-medium text-slate-800">{{ $log->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-600 text-sm">{{ $log->aktivitas }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-16 text-center">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-slate-400 text-sm">Belum ada log aktivitas yang tercatat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
