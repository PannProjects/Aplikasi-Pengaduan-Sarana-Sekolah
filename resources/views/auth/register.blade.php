<x-guest-layout>
    <h2 class="text-xl font-bold text-slate-800 mb-1">Buat Akun Baru</h2>
    <p class="text-sm text-slate-500 mb-6">Daftar sebagai siswa untuk mengirim aspirasi.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Nama lengkap kamu" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Username untuk login" />
            <x-input-error :messages="$errors->get('username')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="nis" class="block text-sm font-medium text-slate-700 mb-1">NIS</label>
            <input id="nis" type="text" name="nis" value="{{ old('nis') }}" required
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Nomor Induk Siswa" />
            <x-input-error :messages="$errors->get('nis')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="kelas" class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
            <input id="kelas" type="text" name="kelas" value="{{ old('kelas') }}" required
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Contoh: XII RPL 2" />
            <x-input-error :messages="$errors->get('kelas')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition shadow-lg shadow-indigo-200">
            Daftar
        </button>

        <p class="text-center text-sm text-slate-500 mt-5">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
