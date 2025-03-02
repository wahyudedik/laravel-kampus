@extends('layouts.app')
@section('menus', 'Manajemen Perangkat Ajar')
@section('page-title', 'Data Perangkat Ajar')
@section('page-subtitle', 'Manajemen perangkat ajar')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('dosen.index') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dosen.update', $perangkatAjar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_perangkat_ajar" class="form-label">Nama Perangkat Ajar</label>
                            <input type="text" class="form-control @error('nama_perangkat_ajar') is-invalid @enderror"
                                id="nama_perangkat_ajar" name="nama_perangkat_ajar"
                                placeholder="Masukkan nama perangkat ajar"
                                value="{{ old('nama_perangkat_ajar', $perangkatAjar->nama_perangkat_ajar) }}" required>
                            @error('nama_perangkat_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <input type="text" class="form-control @error('mata_kuliah') is-invalid @enderror"
                                id="mata_kuliah" name="mata_kuliah" placeholder="Masukkan mata kuliah"
                                value="{{ old('mata_kuliah', $perangkatAjar->mata_kuliah) }}" required>
                            @error('mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" class="form-control @error('semester') is-invalid @enderror"
                                id="semester" name="semester" placeholder="Masukkan semester"
                                value="{{ old('semester', $perangkatAjar->semester) }}" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="date" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                id="tahun_ajaran" name="tahun_ajaran"
                                value="{{ old('tahun_ajaran', $perangkatAjar->tahun_ajaran) }}" required>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="file_perangkat_ajar" class="form-label">File Perangkat Ajar</label>
                            <input type="file" class="form-control @error('file_perangkat_ajar') is-invalid @enderror"
                                id="file_perangkat_ajar" name="file_perangkat_ajar" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Upload file perangkat ajar dalam format PDF">
                            @error('file_perangkat_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> <button type="submit" class="btn btn-primary no-submit-handling">Simpan</button>
            </form>
        </div>
    </div>
@endsection
