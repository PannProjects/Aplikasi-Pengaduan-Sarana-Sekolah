<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Aspirasi Saya</h1>
    </x-slot>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition class="mb-5 flex items-center justify-between bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-400 hover:text-green-600">&times;</button>
        </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-5 border border-slate-200 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ $total }}</p>
                </div>
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-orange-200 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-orange-500 uppercase tracking-wide">Menunggu</p>
                    <p class="text-2xl font-bold text-orange-600 mt-1">{{ $menunggu }}</p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-blue-200 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-blue-500 uppercase tracking-wide">Proses</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $proses }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-green-200 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-green-500 uppercase tracking-wide">Selesai</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ $selesai }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <a href="{{ route('aspirasi.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-5 py-2.5 rounded-lg transition shadow-lg shadow-indigo-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Kirim Aspirasi Baru
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 text-sm">Daftar Aspirasi</h3>
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
                            @if($a->status == 'Menunggu')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-orange-50 text-orange-600 border border-orange-200">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span> Menunggu
                                </span>
                            @elseif($a->status == 'Proses')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600 border border-blue-200">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Proses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-600 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-sm text-slate-500 italic max-w-[200px]">
                            {{ $a->feedback ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-16 text-center">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-slate-400 text-sm">Kamu belum mengirim aspirasi apapun.</p>
                            <a href="{{ route('aspirasi.create') }}" class="inline-flex items-center gap-2 mt-4 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Kirim aspirasi pertamamu
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
