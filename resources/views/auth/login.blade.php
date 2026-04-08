<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-xl font-bold text-slate-800 mb-1">Selamat Datang</h2>
    <p class="text-sm text-slate-500 mb-6">Masuk ke akun kamu untuk melanjutkan.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="login" class="block text-sm font-medium text-slate-700 mb-1">Username / NIS / Email</label>
            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Masukkan username, NIS, atau email" />
            <x-input-error :messages="$errors->get('login')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>
        <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition shadow-lg shadow-indigo-200">
            Masuk
        </button>

        <p class="text-center text-sm text-slate-500 mt-5">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>
