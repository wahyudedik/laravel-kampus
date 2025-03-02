@extends('layouts.app')
@section('menus', 'Manajemen Data User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Manajemen data user')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('users.index') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('users.index') }}" class="btn btn-primary d-sm-none">
            <i class="ti ti-arrow-left"></i>
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukkan nama" value="{{ $user->name }}" required
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Masukkan email" value="{{ $user->email }}" required
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Masukkan alamat email aktif">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan password" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Masukkan password minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Masukkan konfirmasi password" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Masukkan ulang password yang sama">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="usertype" class="form-label">Role</label>
                            <select class="form-select @error('usertype') is-invalid @enderror" id="usertype"
                                name="usertype" required data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih role pengguna">
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="mahasiswa" {{ $user->usertype == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                </option>
                                <option value="dosen" {{ $user->usertype == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            </select>
                            @error('usertype')
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
