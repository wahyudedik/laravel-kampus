@extends('layouts.app')

@section('menus', 'Monitoring RPS Dosen')
@section('page-subtitle', 'Pantau status upload RPS oleh Dosen')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Dosen & Status RPS</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th class="w-1">No</th>
                        <th>Nama Dosen</th>
                        <th>Status Upload</th>
                        <th>Jumlah RPS</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dosens as $dosen)
                        <tr>
                            <td>{{ $loop->iteration + $dosens->firstItem() - 1 }}</td>
                            <td>
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2" style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode($dosen->name) }}&background=random)"></span>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $dosen->name }}</div>
                                        <div class="text-muted"><a href="#" class="text-reset">{{ $dosen->email }}</a></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($dosen->perangkat_ajars_count > 0)
                                    <span class="badge bg-success me-1"></span> Sudah Upload
                                @else
                                    <span class="badge bg-danger me-1"></span> Belum Upload
                                @endif
                            </td>
                            <td>{{ $dosen->perangkat_ajars_count }} RPS</td>
                            <td>
                                <a href="{{ route('rps.index', ['dosen_id' => $dosen->id]) }}" class="btn btn-sm btn-outline-primary">
                                    Lihat RPS
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="ti ti-users fs-1 d-block mb-2"></i>
                                Belum ada data dosen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $dosens->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
