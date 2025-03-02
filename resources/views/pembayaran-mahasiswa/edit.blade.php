@extends('layouts.app')
@section('menus', 'Manajemen Data Pembayaran Mahasiswa')
@section('page-title', 'Edit Pembayaran Mahasiswa')
@section('page-subtitle', 'Manajemen data pembayaran mahasiswa')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('pembayaran-mahasiswa.index') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pembayaran-mahasiswa.update', $pembayaranMahasiswa->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Masukkan nama mahasiswa"
                                value="{{ $pembayaranMahasiswa->nama_mahasiswa }}" required>
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                name="nim" placeholder="Masukkan NIM" value="{{ $pembayaranMahasiswa->nim }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                            <input type="text" class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                id="jenis_pembayaran" name="jenis_pembayaran" placeholder="Masukkan jenis pembayaran"
                                value="{{ $pembayaranMahasiswa->jenis_pembayaran }}" required>
                            @error('jenis_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                id="tanggal_pembayaran" name="tanggal_pembayaran"
                                value="{{ $pembayaranMahasiswa->tanggal_pembayaran->format('Y-m-d') }}" required>
                            @error('tanggal_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                            <input type="number" step="0.01"
                                class="form-control @error('jumlah_pembayaran') is-invalid @enderror" id="jumlah_pembayaran"
                                name="jumlah_pembayaran" placeholder="Masukkan jumlah pembayaran"
                                value="{{ $pembayaranMahasiswa->jumlah_pembayaran }}" required>
                            @error('jumlah_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select class="form-select @error('status_pembayaran') is-invalid @enderror"
                                id="status_pembayaran" name="status_pembayaran" required>
                                <option value="1" {{ $pembayaranMahasiswa->status_pembayaran ? 'selected' : '' }}>
                                    Terbayar</option>
                                <option value="0" {{ !$pembayaranMahasiswa->status_pembayaran ? 'selected' : '' }}>
                                    Belum Terbayar</option>
                            </select>
                            @error('status_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                id="bukti_pembayaran" name="bukti_pembayaran">
                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                placeholder="Masukkan keterangan">{{ $pembayaranMahasiswa->keterangan }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> <button type="submit" class="btn btn-primary no-submit-handling">Simpan</button>
            </form>
        </div>
    </div>
@endsection
