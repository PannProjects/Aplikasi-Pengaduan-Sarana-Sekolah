<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Kirim Aspirasi</h1>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h2 class="font-bold text-slate-800">Form Aspirasi Baru</h2>
                <p class="text-sm text-slate-500 mt-1">Isi formulir di bawah untuk menyampaikan pengaduan sarana sekolah.</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-1.5">Lokasi Kejadian</label>
                        <input id="lokasi" type="text" name="lokasi" value="{{ old('lokasi') }}" required autofocus
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" />
                        <x-input-error :messages="$errors->get('lokasi')" class="mt-1.5" />
                    </div>

                    <div class="mt-5">
                        <label for="kategori_id" class="block text-sm font-medium text-slate-700 mb-1.5">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->ket_kategori }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kategori_id')" class="mt-1.5" />
                    </div>

                    <div class="mt-5">
                        <label for="ket_aspirasi" class="block text-sm font-medium text-slate-700 mb-1.5">Keterangan Aspirasi</label>
                        <textarea id="ket_aspirasi" name="ket_aspirasi" rows="5" required
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition resize-none" placeholder="Jelaskan detail permasalahan yang ingin dilaporkan...">{{ old('ket_aspirasi') }}</textarea>
                        <x-input-error :messages="$errors->get('ket_aspirasi')" class="mt-1.5" />
                    </div>

                    <div class="mt-5" x-data="{ preview: null }">
                        <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1.5">Foto Bukti (Opsional)</label>
                        <div class="relative">
                            <input id="gambar" type="file" name="gambar" accept="image/*"
                                @change="if ($event.target.files[0]) { preview = URL.createObjectURL($event.target.files[0]) }"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 border border-slate-200 rounded-lg cursor-pointer" />
                        </div>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-1.5" />
                        <template x-if="preview">
                            <div class="mt-3">
                                <img :src="preview" class="rounded-lg border border-slate-200 max-h-48 object-cover" />
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center justify-between mt-6 pt-5 border-t border-slate-100">
                        <a href="{{ route('aspirasi.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium transition">&larr; Kembali</a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-6 py-2.5 rounded-lg transition shadow-lg shadow-indigo-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
