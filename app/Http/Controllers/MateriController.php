<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        $materis = Materi::latest()->get();
        return view('materi.index', compact('materis', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settings = Setting::first();
        return view('materi.create', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'semester' => 'required|string|max:50',
            'tahun_ajaran' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
        ]);

        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');
            
            Materi::create([
                'judul_materi' => $request->judul_materi,
                'mata_kuliah' => $request->mata_kuliah,
                'semester' => $request->semester,
                'tahun_ajaran' => $request->tahun_ajaran,
                'deskripsi' => $request->deskripsi,
                'file_materi' => $fileName,
            ]);
            
            return redirect()->route('materi.index')->with('swal_success', 'Materi ajar berhasil diunggah');
        }
        
        return redirect()->back()->with('swal_error', 'Gagal mengunggah file');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $settings = Setting::first();
        $materi = Materi::findOrFail($id);
        return view('materi.show', compact('materi', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $settings = Setting::first();
        $materi = Materi::findOrFail($id);
        return view('materi.edit', compact('materi', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $materi = Materi::findOrFail($id);
        
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'semester' => 'required|string|max:50',
            'tahun_ajaran' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
        ]);
        
        $data = [
            'judul_materi' => $request->judul_materi,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'deskripsi' => $request->deskripsi,
        ];
        
        if ($request->hasFile('file_materi')) {
            // Delete old file
            if (Storage::disk('public')->exists('materi/' . $materi->file_materi)) {
                Storage::disk('public')->delete('materi/' . $materi->file_materi);
            }
            
            // Upload new file
            $file = $request->file('file_materi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');
            
            $data['file_materi'] = $fileName;
        }
        
        $materi->update($data);
        
        return redirect()->route('materi.index')->with('swal_success', 'Materi ajar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);
        
        // Delete file
        if (Storage::disk('public')->exists('materi/' . $materi->file_materi)) {
            Storage::disk('public')->delete('materi/' . $materi->file_materi);
        }
        
        $materi->delete();
        
        return redirect()->route('materi.index')->with('swal_success', 'Materi ajar berhasil dihapus');
    }
}
