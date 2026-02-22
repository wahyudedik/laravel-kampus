<?php

namespace App\Http\Controllers;

use App\Models\PerangkatAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RpsController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan model PerangkatAjar sebagai sumber data RPS
        $query = PerangkatAjar::with('user')->latest();

        // Jika user adalah dosen, hanya tampilkan RPS miliknya sendiri
        if (Auth::user()->usertype == 'dosen') {
            $query->where('user_id', Auth::id());
        }

        if ($request->has('dosen_id')) {
            $query->where('user_id', $request->dosen_id);
        }

        $rps = $query->get();
        return view('rps.index', compact('rps'));
    }

    // Method create dan store dihapus/dinonaktifkan karena Dosen menggunakan DosenController (Perangkat Ajar)
    // untuk mengupload RPS. RpsController hanya digunakan untuk menampilkan list bagi Mahasiswa/Admin.
    // Jika Dosen mengakses rps.create, kita redirect ke dosen.create
    
    public function create()
    {
        return redirect()->route('dosen.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('dosen.create');
    }

    public function destroy($id)
    {
        // Menggunakan logic hapus yang sama dengan DosenController atau redirect
        // Untuk amannya, kita serahkan ke DosenController atau hapus via model PerangkatAjar
        $rps = PerangkatAjar::findOrFail($id);
        
        if (Auth::user()->usertype !== 'admin' && Auth::id() !== $rps->user_id) {
            abort(403, 'Unauthorized action.');
        }

        if ($rps->file_perangkat_ajar) {
             $oldFile = public_path('file_perangkat_ajar/') . $rps->file_perangkat_ajar;
             if (file_exists($oldFile)) {
                 unlink($oldFile);
             }
        }

        $rps->delete();

        return redirect()->route('rps.index')->with('swal_success', 'RPS berhasil dihapus!');
    }

    public function download($id)
    {
        $rps = PerangkatAjar::findOrFail($id);
        // File ada di public/file_perangkat_ajar, bukan di storage/app/public
        $path = public_path('file_perangkat_ajar/' . $rps->file_perangkat_ajar);
        
        if (file_exists($path)) {
            return response()->download($path);
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }
}
