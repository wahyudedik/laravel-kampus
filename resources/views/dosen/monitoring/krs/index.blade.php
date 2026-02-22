@extends('layouts.app')

@section('menus', 'Monitoring KRS Mahasiswa')
@section('page-title', 'Monitoring KRS')
@section('page-subtitle', 'Pantau status upload KRS mahasiswa bimbingan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mahasiswa ({{ $currentSemester }} {{ $currentAcademicYear }})</h3>
        <div class="card-actions">
            <form action="{{ route('dosen.monitoring.krs') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari mahasiswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th class="w-1">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Status Upload</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $mhs)
                    @php
                        $krs = $mhs->krs_uploads->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration + $mahasiswa->firstItem() - 1 }}</td>
                        <td>
                            <div class="d-flex py-1 align-items-center">
                                <span class="avatar me-2" style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode($mhs->name) }}&background=random)"></span>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">{{ $mhs->name }}</div>
                                    <div class="text-muted"><a href="#" class="text-reset">{{ $mhs->email }}</a></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($krs)
                                <span class="badge bg-success me-1"></span> Sudah Upload
                            @else
                                <span class="badge bg-danger me-1"></span> Belum Upload
                            @endif
                        </td>
                        <td>
                            @if($krs)
                                {{ $krs->upload_date->format('d M Y H:i') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($krs)
                                <a href="{{ route('dosen.monitoring.krs.download', $krs->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="ti ti-download me-1"></i> Download
                                </a>
                            @else
                                <span class="text-muted fst-italic">Tidak ada file</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="ti ti-users fs-1 d-block mb-2"></i>
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex align-items-center">
        {{ $mahasiswa->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
