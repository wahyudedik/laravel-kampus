@extends('layouts.app')
@section('menus', 'Materi Ajar')
@section('page-title', 'Detail Materi Ajar')
@section('page-subtitle', 'Informasi lengkap materi ajar')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('materi.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-edit"></i> Edit Materi
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Materi Ajar</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-muted" width="200">Judul Materi</td>
                                <td>{{ $materi->judul_materi }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Mata Kuliah</td>
                                <td>{{ $materi->mata_kuliah }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Semester</td>
                                <td>{{ $materi->semester }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tahun Ajaran</td>
                                <td>{{ $materi->tahun_ajaran->format('Y') }}/{{ $materi->tahun_ajaran->format('Y') + 1 }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Deskripsi</td>
                                <td>{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">File Materi</td>
                                <td>
                                    <a href="{{ asset('storage/materi/' . $materi->file_materi) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="ti ti-download"></i> Download File
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Upload</td>
                                <td>{{ $materi->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Terakhir Diperbarui</td>
                                <td>{{ $materi->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column gap-2">
                                <a href="{{ asset('storage/materi/' . $materi->file_materi) }}" target="_blank" class="btn btn-primary">
                                    <i class="ti ti-download"></i> Download File
                                </a>
                                <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-info">
                                    <i class="ti ti-edit"></i> Edit Materi
                                </a>
                                <form action="{{ route('materi.destroy', $materi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 delete-confirm" data-name="{{ $materi->judul_materi }}">
                                        <i class="ti ti-trash"></i> Hapus Materi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
