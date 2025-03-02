@extends('layouts.app')
@section('menus', 'Manajemen Perangkat Aja')
@section('page-title', 'Detail Perangkat Ajar')
@section('page-subtitle', 'Informasi lengkap perangkat ajar')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('dosen.edit', $perangkatAjar->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-edit"></i> Edit Perangkat Ajar
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Perangkat Ajar</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="avatar avatar-xl mb-3">
                            <span class="avatar-text rounded-circle bg-primary-lt">
                                {{ strtoupper(substr($perangkatAjar->nama_perangkat_ajar, 0, 2)) }}
                            </span>
                        </div>
                        <h4>{{ $perangkatAjar->nama_perangkat_ajar }}</h4>
                        <span class="badge bg-primary text-white">
                            {{ $perangkatAjar->semester }}
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <tbody>
                                <tr>
                                    <td class="text-muted">Nama Perangkat Ajar</td>
                                    <td>{{ $perangkatAjar->nama_perangkat_ajar }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Mata Kuliah</td>
                                    <td>{{ $perangkatAjar->mata_kuliah }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Semester</td>
                                    <td>{{ $perangkatAjar->semester }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tahun Ajaran</td>
                                    <td>{{ $perangkatAjar->tahun_ajaran->format('Y') }}/{{ $perangkatAjar->tahun_ajaran->format('Y') + 1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Dosen</td>
                                    <td>{{ $perangkatAjar->user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">File Perangkat Ajar</td>
                                    <td>
                                        @if ($perangkatAjar->file_perangkat_ajar)
                                            <a href="{{ asset('file_perangkat_ajar/' . $perangkatAjar->file_perangkat_ajar) }}"
                                                target="_blank">Lihat File</a>
                                        @else
                                            <span class="text-muted">Belum ada file</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('dosen.edit', $perangkatAjar->id) }}" class="btn btn-primary me-2">
                        <i class="ti ti-edit"></i> Edit Perangkat Ajar
                    </a>
                    <form action="{{ route('dosen.destroy', $perangkatAjar->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-confirm"
                            data-name="{{ $perangkatAjar->nama_perangkat_ajar }}">
                            <i class="ti ti-trash"></i> Hapus Perangkat Ajar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
