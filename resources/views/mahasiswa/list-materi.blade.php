@extends('layouts.app')
@section('menus', 'Materi Perkuliahan')
@section('page-title', 'Daftar Materi Perkuliahan')
@section('page-subtitle', 'Akses dan unduh materi perkuliahan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Materi</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.materi.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        {{-- <label class="form-label">Mata Kuliah</label> --}}
                        <input type="text" name="mata_kuliah" class="form-control" value="{{ request('mata_kuliah') }}" placeholder="Cari berdasarkan mata kuliah">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        {{-- <label class="form-label">Semester</label> --}}
                        <select name="semester" class="form-select">
                            <option value="">Semua Semester</option>
                            <option value="Ganjil" {{ request('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ request('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-search"></i> Filter
                        </button>
                        <a href="{{ route('mahasiswa.materi.index') }}" class="btn btn-secondary">
                            <i class="ti ti-refresh"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mt-4">
    @forelse ($materis as $materi)
    <div class="col-md-4 mb-4">
        <div class="card card-hover h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">{{ $materi->judul_materi }}</h3>
                    <span class="badge bg-primary text-white">{{ $materi->semester }}</span>
                </div>
                <div class="text-muted mb-3">
                    <p class="mb-1"><strong>Mata Kuliah:</strong> {{ $materi->mata_kuliah }}</p>
                    <p class="mb-1"><strong>Tahun Ajaran:</strong> {{ $materi->tahun_ajaran->format('Y') }}/{{ $materi->tahun_ajaran->format('Y') + 1 }}</p>
                    <p class="mb-1"><strong>File:</strong> {{ $materi->file_materi }}</p>
                </div>
                <div class="mb-3">
                    <h4 class="text-muted fs-5">Deskripsi:</h4>
                    <p>{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Diunggah: {{ $materi->created_at->diffForHumans() }}</span>
                    <a href="{{ route('mahasiswa.materi.download', $materi->id) }}" class="btn btn-primary">
                        <i class="ti ti-download"></i> Unduh Materi
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="empty">
                    <div class="empty-img">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-empty" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M9 10l.01 0"></path>
                            <path d="M15 10l.01 0"></path>
                            <path d="M9 15l6 0"></path>
                        </svg>
                    </div>
                    <p class="empty-title">Tidak ada materi tersedia</p>
                    <p class="empty-subtitle text-muted">
                        Belum ada materi perkuliahan yang diunggah oleh dosen.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($materis->isNotEmpty())
<div class="d-flex justify-content-center mt-4">
    <div class="card card-body border-0 shadow-none">
        <div class="alert alert-info mb-0">
            <div class="d-flex">
                <div>
                    <i class="ti ti-info-circle me-2"></i>
                </div>
                <div>
                    <h4 class="alert-title">Informasi</h4>
                    <div class="text-muted">Materi perkuliahan ini disediakan untuk membantu proses belajar. Silakan unduh dan pelajari sesuai kebutuhan.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
    // Add filter functionality for the search form
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.querySelector('form');
        const mataKuliahInput = document.querySelector('input[name="mata_kuliah"]');
        
        mataKuliahInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                searchForm.submit();
            }
        });
    });
</script>
@endpush