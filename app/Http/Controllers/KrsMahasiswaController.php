<?php

namespace App\Http\Controllers;

use App\Models\KrsUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KrsMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $settings = \App\Models\Setting::first();
        
        // Cek apakah sudah upload KRS untuk semester ini (contoh logika sederhana)
        // Idealnya semester dan tahun akademik diambil dari Setting
        $currentSemester = 'Ganjil'; 
        $currentAcademicYear = '2024/2025';

        $krs = KrsUpload::where('student_id', $user->id)
            ->where('semester', $currentSemester)
            ->where('academic_year', $currentAcademicYear)
            ->first();

        return view('mahasiswa.krs.index', compact('krs', 'currentSemester', 'currentAcademicYear', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_krs' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'semester' => 'required',
            'academic_year' => 'required',
        ]);

        $user = Auth::user();
        $file = $request->file('file_krs');
        $extension = $file->getClientOriginalExtension();
        
        // Format nama file: NIM_NamaMahasiswa_KRS_Semester_TahunAkademik.pdf
        // Karena NIM tidak ada di tabel users default, pakai ID atau Name dulu, atau asumsikan ada kolom nim
        // Kita pakai ID saja dulu sebagai pengganti NIM unik, atau email
        $fileName = $user->id . '_' . str_replace(' ', '_', $user->name) . '_KRS_' . $request->semester . '_' . str_replace('/', '-', $request->academic_year) . '.' . $extension;
        
        $path = $file->storeAs('krs_uploads', $fileName, 'public');

        KrsUpload::updateOrCreate(
            [
                'student_id' => $user->id,
                'semester' => $request->semester,
                'academic_year' => $request->academic_year,
            ],
            [
                'file_path' => $path,
                'upload_date' => now(),
                'status' => 'pending',
            ]
        );

        return redirect()->back()->with('swal_success', 'KRS berhasil diupload!');
    }
}
