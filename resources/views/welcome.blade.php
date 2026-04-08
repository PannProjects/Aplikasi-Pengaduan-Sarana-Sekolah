<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Sampaikan Aspirasimu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .float-anim { animation: float 3s ease-in-out infinite; }
        .max-w-6xl.mx-auto.px-6.py-4.flex.items-center.justify-between {
            background-color: white;
        }
        nav.fixed.w-full.top-0.z-50.bg-white\/80.backdrop-blur-lg.border-b.border-slate-200\/60 {
            background-color: white;
        }
    </style>
</head>
<body class="antialiased bg-slate-50">

    <nav class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200/60">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="font-bold text-slate-800">Pengaduan Sarana Sekolah</span>
            </div>
            <div class="flex items-center gap-3">
            </div>
        </div>
    </nav>
    <section class="pt-28 pb-20 bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-6">
                    Aplikasi Pengaduan<br>
                    <span class="text-indigo-200">Sarana Sekolah</span>
                </h1>
                <p class="text-lg text-indigo-100/80 mb-10 max-w-xl mx-auto">
                    Laporkan kerusakan, kebersihan, dan keamanan sarana sekolah.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto text-center bg-white text-indigo-700 font-bold px-8 py-3.5 rounded-xl hover:bg-indigo-50 transition shadow-xl shadow-black/10">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto text-center border-2 border-white/30 text-white font-medium px-8 py-3.5 rounded-xl hover:bg-white/10 transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-slate-800 mb-3">Cara Kerja</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-5 shadow-lg shadow-indigo-200">1</div>
                    <h3 class="font-bold text-slate-800 mb-2">Daftar Akun</h3>
                    <p class="text-sm text-slate-500">Buat akun siswa dengan NIS dan kelas kamu.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-5 shadow-lg shadow-indigo-200">2</div>
                    <h3 class="font-bold text-slate-800 mb-2">Kirim Laporan</h3>
                    <p class="text-sm text-slate-500">Isi form aspirasi, pilih kategori & lokasi.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-5 shadow-lg shadow-indigo-200">3</div>
                    <h3 class="font-bold text-slate-800 mb-2">Pantau Progres</h3>
                    <p class="text-sm text-slate-500">Lihat status dan umpan balik dari admin.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
