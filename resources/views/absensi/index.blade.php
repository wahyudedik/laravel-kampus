@extends('layouts.app')
@section('menus', 'Absensi Mahasiswa')
@section('page-title', 'Daftar Absensi Mahasiswa')
@section('page-subtitle', 'Kelola absensi mahasiswa per mata kuliah')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Buat Absensi Baru
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter Absensi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            {{-- <label class="form-label">Mata Kuliah</label> --}}
                            <input type="text" name="mata_kuliah" class="form-control"
                                value="{{ request('mata_kuliah') }}" placeholder="Cari berdasarkan mata kuliah">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            {{-- <label class="form-label">Tanggal</label> --}}
                            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="ti ti-search"></i> Filter
                            </button>
                            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                                <i class="ti ti-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Daftar Absensi</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Kode Kelas</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                            <th>Dosen</th>
                            <th>Pertemuan</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensis as $absensi)
                            <tr>
                                <td>{{ $absensi->mata_kuliah }}</td>
                                <td>{{ $absensi->kode_kelas }}</td>
                                <td>{{ $absensi->tanggal->format('d/m/Y') }}</td>
                                <td>{{ substr($absensi->jam_mulai, 0, 5) }} - {{ substr($absensi->jam_selesai, 0, 5) }}</td>
                                <td>{{ $absensi->ruangan }}</td>
                                <td>{{ $absensi->dosen_pengajar }}</td>
                                <td>{{ $absensi->pertemuan }}</td>
                                <td>
                                    <div class="btn-list">
                                        <a href="{{ route('absensi.show', $absensi->id) }}" class="btn btn-sm btn-primary"
                                            data-bs-toggle="tooltip" title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-sm btn-info"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                data-bs-toggle="tooltip" title="Hapus"
                                                data-name="absensi {{ $absensi->mata_kuliah }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data absensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $absensis->links() }}
            </div>
        </div>
    </div>
@endsection
