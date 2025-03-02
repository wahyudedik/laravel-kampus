@extends('layouts.app')
@section('menus', 'Manajemen Data User')
@section('page-title', 'Detail User')
@section('page-subtitle', 'Informasi lengkap pengguna')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('users.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-edit"></i> Edit User
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Pengguna</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="avatar avatar-xl mb-3">
                            <span class="avatar-text rounded-circle bg-primary-lt">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                        <h4>{{ $user->name }}</h4>
                        <span class="badge bg-{{ $user->usertype == 'admin' ? 'danger text-white' : ($user->usertype == 'dosen' ? 'info text-white' : 'success text-white') }}">
                            {{ ucfirst($user->usertype) }}
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <tbody>
                                <tr>
                                    <td class="text-muted">Nama Lengkap</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status Email</td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success text-white">Terverifikasi</span>
                                            <small class="text-muted ms-2">pada {{ $user->email_verified_at->format('d M Y H:i') }}</small>
                                        @else
                                            <span class="badge bg-warning text-white">Belum Terverifikasi</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tipe Pengguna</td>
                                    <td>{{ ucfirst($user->usertype) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Bergabung Sejak</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Terakhir Diperbarui</td>
                                    <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">
                        <i class="ti ti-edit"></i> Edit User
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-confirm" data-name="{{ $user->name }}">
                            <i class="ti ti-trash"></i> Hapus User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
