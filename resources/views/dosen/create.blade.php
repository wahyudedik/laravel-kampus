@extends('layouts.app')
@section('menus', 'Manajemen RPS Mata Kuliah')
@section('page-title', 'Data RPS Mata Kuliah')
@section('page-subtitle', 'Manajemen RPS mata kuliah')
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
            <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_perangkat_ajar" class="form-label">Nama Perangkat Ajar</label>
                            <input type="text" class="form-control @error('nama_perangkat_ajar') is-invalid @enderror"
                                id="nama_perangkat_ajar" name="nama_perangkat_ajar"
                                placeholder="Masukkan nama perangkat ajar" value="{{ old('nama_perangkat_ajar') }}"
                                required>
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
                                value="{{ old('mata_kuliah') }}" required>
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
                                id="semester" name="semester" placeholder="Masukkan semester" value="{{ old('semester') }}"
                                required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <div class="input-group">
                                <select class="form-select @error('tahun_ajaran_mulai') is-invalid @enderror" name="tahun_ajaran_mulai" required>
                                    <option value="">Dari</option>
                                    @for($i = date('Y') - 5; $i <= date('Y') + 10; $i++)
                                        <option value="{{ $i }}" {{ old('tahun_ajaran_mulai') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="input-group-text">/</span>
                                <select class="form-select @error('tahun_ajaran_selesai') is-invalid @enderror" name="tahun_ajaran_selesai" required>
                                    <option value="">Sampai</option>
                                    @for($i = date('Y') - 5; $i <= date('Y') + 10; $i++)
                                        <option value="{{ $i }}" {{ old('tahun_ajaran_selesai') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            @if($errors->has('tahun_ajaran_mulai') || $errors->has('tahun_ajaran_selesai'))
                                <div class="invalid-feedback d-block">Tahun ajaran harus diisi lengkap.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="file_perangkat_ajar" class="form-label">File Perangkat Ajar</label>
                            <input type="file" class="form-control @error('file_perangkat_ajar') is-invalid @enderror"
                                id="file_perangkat_ajar" name="file_perangkat_ajar" required data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Upload file perangkat ajar dalam format PDF">
                            @error('file_perangkat_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> 
                <button type="submit" class="btn btn-primary no-submit-handling">Simpan</button>
            </form>
        </div>
    </div>
@endsection
