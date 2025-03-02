<?php

namespace App\Http\Controllers;

use App\Models\PerangkatAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = PerangkatAjar::where('user_id', Auth::user()->id)->paginate(5);
        return view('dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perangkat_ajar' => 'required',
            'mata_kuliah' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'file_perangkat_ajar' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_perangkat_ajar')) {
            $file = $request->file('file_perangkat_ajar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file_perangkat_ajar'), $filename);
        }

        $perangkatAjar = new PerangkatAjar([
            'user_id' => Auth::user()->id,
            'nama_perangkat_ajar' => $request->nama_perangkat_ajar,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'file_perangkat_ajar' => $filename,
        ]);

        $perangkatAjar->save();

        return redirect()->route('dosen.index')
            ->with('success', 'Perangkat ajar berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perangkatAjar = PerangkatAjar::findOrFail($id);
        return view('dosen.show', compact('perangkatAjar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perangkatAjar = PerangkatAjar::findOrFail($id);
        return view('dosen.edit', compact('perangkatAjar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perangkatAjar = PerangkatAjar::findOrFail($id);

        $request->validate([
            'nama_perangkat_ajar' => 'required',
            'mata_kuliah' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        if ($request->hasFile('file_perangkat_ajar')) {
            $request->validate([
                'file_perangkat_ajar' => 'mimes:pdf|max:2048',
            ]);

            // Hapus file lama
            if ($perangkatAjar->file_perangkat_ajar) {
                $oldFile = public_path('file_perangkat_ajar/') . $perangkatAjar->file_perangkat_ajar;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            // Upload file baru
            $file = $request->file('file_perangkat_ajar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file_perangkat_ajar'), $filename);

            $perangkatAjar->file_perangkat_ajar = $filename;
        }

        $perangkatAjar->user_id = Auth::user()->id;
        $perangkatAjar->nama_perangkat_ajar = $request->nama_perangkat_ajar;
        $perangkatAjar->mata_kuliah = $request->mata_kuliah;
        $perangkatAjar->semester = $request->semester;
        $perangkatAjar->tahun_ajaran = $request->tahun_ajaran;
        $perangkatAjar->save();

        return redirect()->route('dosen.index')
            ->with('success', 'Perangkat ajar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perangkatAjar = PerangkatAjar::findOrFail($id);

        // Hapus file bukti pembayaran jika ada
        if ($perangkatAjar->file_perangkat_ajar) {
            $oldFile = public_path('file_perangkat_ajar/') . $perangkatAjar->file_perangkat_ajar;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $perangkatAjar->delete();

        return redirect()->route('dosen.index')
            ->with('swal_success', 'Perangkat ajar berhasil dihapus.');
    }
}
