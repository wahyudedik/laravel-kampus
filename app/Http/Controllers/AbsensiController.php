<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $settings = Setting::first();
        $query = Absensi::query();
        
        // Filter berdasarkan mata kuliah jika ada
        if ($request->has('mata_kuliah') && $request->mata_kuliah != '') {
            $query->where('mata_kuliah', 'like', '%' . $request->mata_kuliah . '%');
        }
        
        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }
        
        $absensis = $query->latest()->paginate(10);
        
        return view('absensi.index', compact('absensis', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settings = Setting::first();
        return view('absensi.create', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'kode_kelas' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required|string|max:50',
            'dosen_pengajar' => 'required|string|max:255',
            'pertemuan' => 'required|string|max:50',
            'materi_perkuliahan' => 'nullable|string',
            'mahasiswa' => 'required|array|min:1',
            'mahasiswa.*.nim' => 'required|string',
            'mahasiswa.*.nama' => 'required|string',
            'mahasiswa.*.status' => 'required|in:hadir,izin,sakit,alpa',
            'mahasiswa.*.keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Simpan data absensi
            $absensi = Absensi::create([
                'mata_kuliah' => $request->mata_kuliah,
                'kode_kelas' => $request->kode_kelas,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'ruangan' => $request->ruangan,
                'dosen_pengajar' => $request->dosen_pengajar,
                'pertemuan' => $request->pertemuan,
                'materi_perkuliahan' => $request->materi_perkuliahan,
            ]);

            // Simpan data kehadiran mahasiswa
            foreach ($request->mahasiswa as $mhs) {
                AbsensiMahasiswa::create([
                    'absensi_id' => $absensi->id,
                    'nim' => $mhs['nim'],
                    'nama_mahasiswa' => $mhs['nama'],
                    'status' => $mhs['status'],
                    'keterangan' => $mhs['keterangan'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('absensi.index')->with('swal_success', 'Data absensi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $settings = Setting::first();
        $absensi = Absensi::with('mahasiswas')->findOrFail($id);
        
        return view('absensi.show', compact('absensi', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $settings = Setting::first();
        $absensi = Absensi::with('mahasiswas')->findOrFail($id);
        
        return view('absensi.edit', compact('absensi', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'kode_kelas' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required|string|max:50',
            'dosen_pengajar' => 'required|string|max:255',
            'pertemuan' => 'required|string|max:50',
            'materi_perkuliahan' => 'nullable|string',
            'mahasiswa' => 'required|array|min:1',
            'mahasiswa.*.id' => 'nullable|exists:absensi_mahasiswa,id',
            'mahasiswa.*.nim' => 'required|string',
            'mahasiswa.*.nama' => 'required|string',
            'mahasiswa.*.status' => 'required|in:hadir,izin,sakit,alpa',
            'mahasiswa.*.keterangan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);

        DB::beginTransaction();
        try {
            // Update data absensi
            $absensi->update([
                'mata_kuliah' => $request->mata_kuliah,
                'kode_kelas' => $request->kode_kelas,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'ruangan' => $request->ruangan,
                'dosen_pengajar' => $request->dosen_pengajar,
                'pertemuan' => $request->pertemuan,
                'materi_perkuliahan' => $request->materi_perkuliahan,
            ]);

            // Hapus data mahasiswa yang tidak ada di request
            $existingIds = collect($request->mahasiswa)
                ->pluck('id')
                ->filter()
                ->toArray();
            
            AbsensiMahasiswa::where('absensi_id', $absensi->id)
                ->whereNotIn('id', $existingIds)
                ->delete();

            // Update atau tambah data kehadiran mahasiswa
            foreach ($request->mahasiswa as $mhs) {
                if (isset($mhs['id']) && $mhs['id']) {
                    // Update data yang sudah ada
                    AbsensiMahasiswa::where('id', $mhs['id'])->update([
                        'nim' => $mhs['nim'],
                        'nama_mahasiswa' => $mhs['nama'],
                        'status' => $mhs['status'],
                        'keterangan' => $mhs['keterangan'] ?? null,
                    ]);
                } else {
                    // Tambah data baru
                    AbsensiMahasiswa::create([
                        'absensi_id' => $absensi->id,
                        'nim' => $mhs['nim'],
                        'nama_mahasiswa' => $mhs['nama'],
                        'status' => $mhs['status'],
                        'keterangan' => $mhs['keterangan'] ?? null,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('absensi.index')->with('swal_success', 'Data absensi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absensi = Absensi::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Hapus semua data kehadiran mahasiswa
            AbsensiMahasiswa::where('absensi_id', $absensi->id)->delete();
            
            // Hapus data absensi
            $absensi->delete();
            
            DB::commit();
            return redirect()->route('absensi.index')->with('swal_success', 'Data absensi berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Export absensi to PDF.
     */
    public function exportPdf(string $id)
    {
        $absensi = Absensi::with('mahasiswas')->findOrFail($id);
        $settings = Setting::first();
        
        // Implementasi export PDF bisa menggunakan library seperti dompdf
        // Contoh sederhana:
        $pdf = app('dompdf.wrapper')->loadView('absensi.pdf', compact('absensi', 'settings'));
        return $pdf->download('absensi-' . $absensi->mata_kuliah . '-' . $absensi->tanggal->format('Y-m-d') . '.pdf');
    }

    /**
     * Export absensi to Excel.
     */
    public function exportExcel(string $id)
    {
        $absensi = Absensi::with('mahasiswas')->findOrFail($id);
        
        // Implementasi export Excel bisa menggunakan library seperti Laravel Excel
        return Excel::download(new \App\Exports\AbsensiExport($absensi), 'absensi-' . $absensi->mata_kuliah . '-' . $absensi->tanggal->format('Y-m-d') . '.xlsx');
    }
}
