<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonitoringKrsDosenController extends Controller
{
    public function index(Request $request)
    {
        $currentSemester = 'Ganjil';
        $currentAcademicYear = '2024/2025';

        $mahasiswa = User::where('usertype', 'mahasiswa')
            ->with(['krs_uploads' => function ($query) use ($currentSemester, $currentAcademicYear) {
                $query->where('semester', $currentSemester)
                      ->where('academic_year', $currentAcademicYear);
            }])
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);

        return view('dosen.monitoring.krs.index', compact('mahasiswa', 'currentSemester', 'currentAcademicYear'));
    }

    public function download($id)
    {
        // $id di sini adalah krs_upload_id
        $krs = \App\Models\KrsUpload::findOrFail($id);
        
        return Storage::disk('public')->download($krs->file_path);
    }
}
