@extends('layouts.app')
@section('menus', 'Absensi Mahasiswa')
@section('page-title', 'Detail Absensi')
@section('page-subtitle', 'Informasi detail absensi mahasiswa')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-edit"></i> Edit Absensi
        </a>
        <div class="dropdown d-none d-sm-inline-block">
            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="ti ti-download"></i> Export
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('absensi.export-pdf', $absensi->id) }}">
                    <i class="ti ti-file-text"></i> Export PDF
                </a>
                <a class="dropdown-item" href="{{ route('absensi.export-excel', $absensi->id) }}">
                    <i class="ti ti-table"></i> Export Excel
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Absensi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-muted" width="200">Mata Kuliah</td>
                            <td><strong>{{ $absensi->mata_kuliah }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kode Kelas</td>
                            <td>{{ $absensi->kode_kelas }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal</td>
                            <td>{{ $absensi->tanggal->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jam</td>
                            <td>{{ substr($absensi->jam_mulai, 0, 5) }} - {{ substr($absensi->jam_selesai, 0, 5) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-muted" width="200">Ruangan</td>
                            <td>{{ $absensi->ruangan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dosen Pengajar</td>
                            <td>{{ $absensi->dosen_pengajar }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pertemuan</td>
                            <td>{{ $absensi->pertemuan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Materi Perkuliahan</td>
                            <td>{{ $absensi->materi_perkuliahan ?? 'Tidak ada materi' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Daftar Kehadiran Mahasiswa</h3>
            <div class="card-actions">
                <span class="badge bg-primary text-white">Total: {{ $absensi->mahasiswas->count() }} mahasiswa</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi->mahasiswas as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama_mahasiswa }}</td>
                                <td>
                                    @if ($mhs->status == 'hadir')
                                        <span class="badge bg-success text-white">Hadir</span>
                                    @elseif ($mhs->status == 'izin')
                                        <span class="badge bg-info text-white">Izin</span>
                                    @elseif ($mhs->status == 'sakit')
                                        <span class="badge bg-warning text-white">Sakit</span>
                                    @else
                                        <span class="badge bg-danger text-white">Alpa</span>
                                    @endif
                                </td>
                                <td>{{ $mhs->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data mahasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2" style="width: 15px; height: 15px; background-color: #2fb344; border-radius: 50%;"></div>
                            <span>Hadir: {{ $absensi->mahasiswas->where('status', 'hadir')->count() }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2" style="width: 15px; height: 15px; background-color: #4299e1; border-radius: 50%;"></div>
                            <span>Izin: {{ $absensi->mahasiswas->where('status', 'izin')->count() }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2" style="width: 15px; height: 15px; background-color: #f59f00; border-radius: 50%;"></div>
                            <span>Sakit: {{ $absensi->mahasiswas->where('status', 'sakit')->count() }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2" style="width: 15px; height: 15px; background-color: #e53e3e; border-radius: 50%;"></div>
                            <span>Alpa: {{ $absensi->mahasiswas->where('status', 'alpa')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
