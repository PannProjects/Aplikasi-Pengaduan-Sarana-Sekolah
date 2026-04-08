<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Data Siswa</h1>
    </x-slot>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 text-sm">Daftar Akun Siswa</h3>
            <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">{{ $siswas->count() }} siswa</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50/80 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Username</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Terdaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($siswas as $i => $s)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $i + 1 }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($s->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $s->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-600 text-sm">{{ $s->username ?? '-' }}</td>
                        <td class="px-5 py-3.5 font-mono text-xs text-slate-500">{{ $s->nis ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-block px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-600 rounded-full">{{ $s->kelas ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500 text-sm">{{ $s->email ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $s->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-slate-400 text-sm">Belum ada siswa yang terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
