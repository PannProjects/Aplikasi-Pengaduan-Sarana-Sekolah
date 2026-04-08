<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->peran == 'admin') {
            $query = Aspirasi::with(['user', 'kategori'])->where('status', '!=', 'Selesai');

            if ($request->filled('tgl')) {
                $query->whereDate('created_at', $request->tgl);
            }
            if ($request->filled('bulan')) {
                $query->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('nis')) {
                $query->where('nis', $request->nis);
            }
            if ($request->filled('kategori')) {
                $query->where('kategori_id', $request->kategori);
            }

            $aspirasis = $query->latest()->get();
            $kategoris = Kategori::all();

            $total = Aspirasi::count();
            $menunggu = Aspirasi::where('status', 'Menunggu')->count();
            $proses = Aspirasi::where('status', 'Proses')->count();
            $selesai = Aspirasi::where('status', 'Selesai')->count();

            return view('aspirasi.admin_index', compact('aspirasis', 'kategoris', 'total', 'menunggu', 'proses', 'selesai'));
        } else {
            $aspirasis = Aspirasi::where('nis', $user->nis)->where('status', '!=', 'Selesai')->with('kategori')->latest()->get();

            $total = Aspirasi::where('nis', $user->nis)->count();
            $menunggu = Aspirasi::where('nis', $user->nis)->where('status', 'Menunggu')->count();
            $proses = Aspirasi::where('nis', $user->nis)->where('status', 'Proses')->count();
            $selesai = Aspirasi::where('nis', $user->nis)->where('status', 'Selesai')->count();

            return view('aspirasi.siswa_index', compact('aspirasis', 'total', 'menunggu', 'proses', 'selesai'));
        }
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|string|max:255',
            'ket_aspirasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('aspirasi', 'public');
        }

        Aspirasi::create([
            'nis' => Auth::user()->nis,
            'kelas' => Auth::user()->kelas,
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'ket_aspirasi' => $request->ket_aspirasi,
            'gambar' => $gambarPath,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        if (Auth::user()->peran != 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string',
        ]);

        $aspirasi->update($request->only('status', 'feedback'));

        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Memperbarui status aspirasi dari siswa bernama {$aspirasi->user->name} menjadi {$request->status}"
        ]);

        return redirect()->back()->with('success', 'Status/Feedback berhasil diperbarui!');
    }

    public function siswa()
    {
        if (Auth::user()->peran != 'admin') {
            abort(403);
        }

        $siswas = User::where('peran', 'siswa')->latest()->get();

        return view('siswa.index', compact('siswas'));
    }

    public function riwayat(Request $request)
    {
        $user = Auth::user();

        if ($user->peran == 'admin') {
            $query = Aspirasi::with(['user', 'kategori'])->where('status', 'Selesai');

            if ($request->filled('tgl')) {
                $query->whereDate('created_at', $request->tgl);
            }
            if ($request->filled('bulan')) {
                $query->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('nis')) {
                $query->where('nis', $request->nis);
            }
            if ($request->filled('kategori')) {
                $query->where('kategori_id', $request->kategori);
            }

            $aspirasis = $query->latest()->get();
            $kategoris = Kategori::all();

            return view('aspirasi.admin_riwayat', compact('aspirasis', 'kategoris'));
        } else {
            $aspirasis = Aspirasi::where('nis', $user->nis)->where('status', 'Selesai')->with('kategori')->latest()->get();
            return view('aspirasi.siswa_riwayat', compact('aspirasis'));
        }
    }

    public function destroy(Aspirasi $aspirasi)
    {
        if (Auth::user()->peran != 'admin') {
            abort(403);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus aspirasi dari siswa bernama {$aspirasi->user->name}"
        ]);

        $aspirasi->delete();

        return redirect()->back()->with('success', 'Aspirasi berhasil dihapus!');
    }
}
