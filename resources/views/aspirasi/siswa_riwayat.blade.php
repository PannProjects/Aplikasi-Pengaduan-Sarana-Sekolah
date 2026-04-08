<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Riwayat Aspirasi Selesai</h1>
    </x-slot>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition class="mb-5 flex items-center justify-between bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-400 hover:text-green-600">&times;</button>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 text-sm">Aspirasi Telah Selesai</h3>
            <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">{{ $aspirasis->count() }} data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50/80 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Umpan Balik</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($aspirasis as $a)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-5 py-3.5 text-slate-500 text-xs whitespace-nowrap">{{ $a->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-block px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-600 rounded-full">{{ $a->kategori->ket_kategori }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-slate-600">{{ $a->lokasi }}</td>
                        <td class="px-5 py-3.5 text-slate-500 text-xs max-w-[250px]">{{ $a->ket_aspirasi }}</td>
                        <td class="px-5 py-3.5">
                            @if($a->gambar)
                                <a href="{{ asset('storage/' . $a->gambar) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $a->gambar) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 hover:scale-150 transition cursor-pointer" />
                                </a>
                            @else
                                <span class="text-xs text-slate-300">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-600 border border-green-200">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Selesai
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-sm text-slate-500 italic max-w-[200px]">
                            {{ $a->feedback ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-slate-400 text-sm">Belum ada aspirasi yang berstatus selesai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
