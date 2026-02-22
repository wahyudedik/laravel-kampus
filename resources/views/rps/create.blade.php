@extends('layouts.app')

@section('menus', 'Upload RPS Baru')
@section('page-title', 'Upload Rencana Program Semester')
@section('page-subtitle', 'Isi formulir untuk mengupload RPS baru')

@section('content')
<div class="row row-cards">
    <div class="col-md-6 offset-md-3">
        <form action="{{ route('rps.store') }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Form Upload RPS</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama Mata Kuliah</label>
                    <input type="text" class="form-control @error('mata_kuliah') is-invalid @enderror" 
                           name="mata_kuliah" placeholder="Contoh: Pemrograman Web Lanjut" value="{{ old('mata_kuliah') }}" required>
                    @error('mata_kuliah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required">Semester</label>
                    <select class="form-select @error('semester') is-invalid @enderror" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required">Tahun Ajaran</label>
                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" 
                           name="tahun_ajaran" placeholder="Contoh: 2023/2024" value="{{ old('tahun_ajaran') }}" required>
                    @error('tahun_ajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-label required">Upload File RPS (PDF)</div>
                    <input type="file" class="form-control @error('file_rps') is-invalid @enderror" name="file_rps" accept=".pdf" required>
                    <small class="form-hint">Hanya file PDF yang diperbolehkan. Maksimal ukuran 10MB.</small>
                    @error('file_rps')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('rps.index') }}" class="btn btn-link link-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ms-auto">
                    <i class="ti ti-upload me-2"></i> Upload RPS
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
