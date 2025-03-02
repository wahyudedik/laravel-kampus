<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranMahasiswa;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\delete;

class PembayaranMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaranMahasiswas = PembayaranMahasiswa::paginate(5);
        return view('pembayaran-mahasiswa.index', compact('pembayaranMahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembayaran-mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'jenis_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaran = $request->file('bukti_pembayaran');
            $buktiPembayaranName = time() . '.' . $buktiPembayaran->getClientOriginalExtension();
            $buktiPembayaran->move(public_path('bukti_pembayaran'), $buktiPembayaranName);
        }

        $pembayaranMahasiswa = new PembayaranMahasiswa([
            'user_id' => Auth::user()->id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'bukti_pembayaran' => $buktiPembayaranName,
            'keterangan' => $request->keterangan,
        ]);

        $pembayaranMahasiswa->save();

        return redirect()->route('pembayaran-mahasiswa.index')
            ->with('swal_success', 'Pembayaran mahasiswa berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembayaranMahasiswa = PembayaranMahasiswa::findOrFail($id);
        $pembayaranMahasiswaAll = PembayaranMahasiswa::where('user_id', $pembayaranMahasiswa->user_id)->get();
        return view('pembayaran-mahasiswa.show', compact('pembayaranMahasiswa', 'pembayaranMahasiswaAll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaranMahasiswa = PembayaranMahasiswa::findOrFail($id);
        return view('pembayaran-mahasiswa.edit', compact('pembayaranMahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pembayaranMahasiswa = PembayaranMahasiswa::findOrFail($id);

        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'jenis_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $request->validate([
                'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hapus file lama
            if ($pembayaranMahasiswa->bukti_pembayaran) {
                $oldFile = public_path('bukti_pembayaran/') . $pembayaranMahasiswa->bukti_pembayaran;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            // Upload file baru
            $buktiPembayaran = $request->file('bukti_pembayaran');
            $buktiPembayaranName = time() . '.' . $buktiPembayaran->getClientOriginalExtension();
            $buktiPembayaran->move(public_path('bukti_pembayaran'), $buktiPembayaranName);
        }
        $pembayaranMahasiswa = new PembayaranMahasiswa([
            'user_id' => Auth::user()->id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'bukti_pembayaran' => $buktiPembayaranName,
            'keterangan' => $request->keterangan,
        ]);
        $pembayaranMahasiswa->update();

        return redirect()->route('pembayaran-mahasiswa.index')
            ->with('swal_success', 'Pembayaran mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaranMahasiswa = PembayaranMahasiswa::findOrFail($id);

        // Hapus file bukti pembayaran jika ada
        if ($pembayaranMahasiswa->bukti_pembayaran) {
            $oldFile = public_path('bukti_pembayaran/') . $pembayaranMahasiswa->bukti_pembayaran;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $pembayaranMahasiswa->delete();

        return redirect()->route('pembayaran-mahasiswa.index')
            ->with('swal_success', 'Pembayaran mahasiswa berhasil dihapus.');
    }
}
