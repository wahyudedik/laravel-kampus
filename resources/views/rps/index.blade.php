@extends('layouts.app')

@section('menus', 'List Data RPS')
@section('page-subtitle', 'Daftar Rencana Program Semester Dosen')

@section('page-actions')
    @if (Auth::user()->usertype == 'dosen')
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">
            <i class="ti ti-upload me-2"></i> Upload RPS Baru
        </a>
    @endif
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perangkat Ajar</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Nama Dosen</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>File RPS</th>
                        @if (Auth::user()->usertype == 'dosen' || Auth::user()->usertype == 'admin')
                            <th class="w-1">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($rps as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_perangkat_ajar }}</td>
                            <td>{{ $item->mata_kuliah }}</td>
                            <td>
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2"
                                        style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=random)"></span>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $item->user->name }}</div>
                                        <div class="text-muted"><a href="#"
                                                class="text-reset">{{ $item->user->email }}</a></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $item->semester == 'Ganjil' ? 'bg-blue-lt' : 'bg-green-lt' }}">
                                    {{ $item->semester }}
                                </span>
                            </td>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>
                                <a href="{{ route('rps.download', $item->id) }}" class="btn btn-outline-primary btn-sm"
                                    target="_blank">
                                    <i class="ti ti-file-download me-2"></i> Download PDF
                                </a>
                            </td>
                            @if (Auth::user()->usertype == 'dosen' || Auth::user()->usertype == 'admin')
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        @if (Auth::user()->usertype == 'admin' || (Auth::user()->usertype == 'dosen' && Auth::id() == $item->user_id))
                                            <form action="{{ route('rps.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-icon btn-sm delete-confirm"
                                                    data-name="RPS {{ $item->mata_kuliah }}" data-bs-toggle="tooltip"
                                                    title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->usertype == 'dosen' || Auth::user()->usertype == 'admin' ? 8 : 7 }}"
                                class="text-center text-muted py-5">
                                <i class="ti ti-file-off fs-1 d-block mb-2"></i>
                                Belum ada data RPS yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
