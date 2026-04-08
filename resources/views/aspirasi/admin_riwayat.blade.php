<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Riwayat Aspirasi (Selesai)</h1>
    </x-slot>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition class="mb-5 flex items-center justify-between bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-400 hover:text-green-600">&times;</button>
        </div>
    @endif

    <div x-data="aspirasi()" x-init="init()">
        <div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
            <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Saring Data Selesai
                <span x-show="isFiltering" x-transition class="text-xs font-normal text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-full">Realtime</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Cari NIS / Nama</label>
                    <input type="text" x-model="filters.search" placeholder="Ketik NIS atau nama..."
                        class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Tanggal</label>
                    <input type="date" x-model="filters.tanggal"
                        class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Bulan</label>
                    <select x-model="filters.bulan" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Bulan</option>
                        @php $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; @endphp
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $bulan[$i-1] }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Kategori</label>
                    <select x-model="filters.kategori" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->ket_kategori }}">{{ $k->ket_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button @click="resetFilters()" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 text-sm font-medium text-slate-500 bg-slate-100 rounded-lg hover:bg-slate-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Atur Ulang
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800 text-sm">Aspirasi Telah Selesai</h3>
                <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full" x-text="filtered.length + ' data'"></span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50/80 text-left">
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Siswa</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-for="a in filtered" :key="a.id">
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-5 py-3.5 font-mono text-xs text-slate-500" x-text="a.nis"></td>
                                <td class="px-5 py-3.5 font-medium text-slate-800" x-text="a.nama"></td>
                                <td class="px-5 py-3.5 text-slate-500 text-xs" x-text="a.tanggal_tampil"></td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-block px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-600 rounded-full" x-text="a.kategori"></span>
                                </td>
                                <td class="px-5 py-3.5 text-slate-600 text-sm" x-text="a.lokasi"></td>
                                <td class="px-5 py-3.5 text-slate-500 text-xs max-w-[200px] truncate" x-text="a.keterangan"></td>
                                <td class="px-5 py-3.5">
                                    <template x-if="a.gambar">
                                        <a :href="'/storage/' + a.gambar" target="_blank">
                                            <img :src="'/storage/' + a.gambar" class="w-12 h-12 rounded-lg object-cover border border-slate-200 hover:scale-150 transition cursor-pointer" />
                                        </a>
                                    </template>
                                    <span x-show="!a.gambar" class="text-xs text-slate-300">-</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-600 border border-green-200">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Selesai
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <form :action="'/aspirasi/' + a.id" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filtered.length === 0">
                            <td colspan="9" class="px-5 py-16 text-center">
                                <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-slate-400 text-sm">Tidak ada riwayat aspirasi yang cocok.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function aspirasi() {
            return {
                allData: [],
                filters: { search: '', tanggal: '', bulan: '', kategori: '' },
                init() {
                    this.allData = [
                        @foreach($aspirasis as $a)
                        {
                            id: {{ $a->id }},
                            nis: '{{ $a->nis }}',
                            nama: '{{ e($a->user->name ?? "N/A") }}',
                            tanggal: '{{ $a->created_at->format("Y-m-d") }}',
                            tanggal_tampil: '{{ $a->created_at->format("d/m/Y") }}',
                            bulan: {{ $a->created_at->month }},
                            kategori: '{{ e($a->kategori->ket_kategori) }}',
                            lokasi: '{{ e($a->lokasi) }}',
                            keterangan: `{{ e($a->ket_aspirasi) }}`,
                            gambar: '{{ $a->gambar ?? '' }}'
                        },
                        @endforeach
                    ];
                },
                get isFiltering() {
                    return this.filters.search || this.filters.tanggal || this.filters.bulan || this.filters.kategori;
                },
                get filtered() {
                    let data = this.allData;
                    if (this.filters.search) {
                        const q = this.filters.search.toLowerCase();
                        data = data.filter(d => d.nis.toLowerCase().includes(q) || d.nama.toLowerCase().includes(q));
                    }
                    if (this.filters.tanggal) {
                        data = data.filter(d => d.tanggal === this.filters.tanggal);
                    }
                    if (this.filters.bulan) {
                        data = data.filter(d => d.bulan == this.filters.bulan);
                    }
                    if (this.filters.kategori) {
                        data = data.filter(d => d.kategori === this.filters.kategori);
                    }
                    return data;
                },
                resetFilters() {
                    this.filters = { search: '', tanggal: '', bulan: '', kategori: '' };
                }
            }
        }
    </script>
</x-app-layout>
