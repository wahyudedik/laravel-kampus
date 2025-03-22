<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaMateriController extends Controller
{
    /**
     * Display a listing of the materials available for students.
     */
    public function index(Request $request)
    {
        $settings = Setting::first();
        
        // Start with a base query
        $query = Materi::query();
        
        // Apply filters if they exist
        if ($request->filled('mata_kuliah')) {
            $query->where('mata_kuliah', 'like', '%' . $request->mata_kuliah . '%');
        }
        
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        
        // Get the filtered materials ordered by latest first
        $materis = $query->latest()->get();
        
        return view('mahasiswa.list-materi', compact('materis', 'settings'));
    }

    /**
     * Download a specific material file.
     */
    public function download($id)
    {
        $materi = Materi::findOrFail($id);
        
        if (Storage::disk('public')->exists('materi/' . $materi->file_materi)) {
            return response()->download(storage_path('app/public/materi/' . $materi->file_materi));
        }
        
        return redirect()->back()->with('swal_error', 'File tidak ditemukan');
    }
}
