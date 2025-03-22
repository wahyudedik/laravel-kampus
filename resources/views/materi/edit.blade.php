@extends('layouts.app')
@section('menus', 'Materi Ajar')
@section('page-title', 'Edit Materi Ajar')
@section('page-subtitle', 'Form edit materi ajar')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('materi.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('materi.show', $materi->id) }}" class="btn btn-info d-none d-sm-inline-block">
            <i class="ti ti-eye"></i> Lihat Detail
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Materi Ajar</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Judul Materi</label>
                            <input type="text" name="judul_materi" class="form-control @error('judul_materi') is-invalid @enderror" value="{{ old('judul_materi', $materi->judul_materi) }}" required>
                            @error('judul_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" class="form-control @error('mata_kuliah') is-invalid @enderror" value="{{ old('mata_kuliah', $materi->mata_kuliah) }}" required>
                            @error('mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Semester</label>
                            <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil" {{ old('semester', $materi->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ old('semester', $materi->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Tahun Ajaran</label>
                            <input type="date" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $materi->tahun_ajaran->format('Y-m-d')) }}" required>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">File Materi</label>
                            <input type="file" name="file_materi" class="form-control @error('file_materi') is-invalid @enderror">
                            <small class="form-hint">Format yang diizinkan: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, RAR (Maks. 10MB)</small>
                            <small class="form-hint">Biarkan kosong jika tidak ingin mengubah file</small>
                            @error('file_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File Saat Ini</label>
                            <div class="d-flex align-items-center">
                                <span class="me-2">{{ $materi->file_materi }}</span>
                                <a href="{{ asset('storage/materi/' . $materi->file_materi) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="ti ti-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Perbarui Materi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
