@extends('layouts.app')
@section('menus', 'Manajemen RPS Mata Kuliah')
@section('page-title', 'Data RPS Mata Kuliah')
@section('page-subtitle', 'Manajemen RPS mata kuliah')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('dosen.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Tambah Perangkat Ajar
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-3">
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" class="form-control" id="search-input" placeholder="Cari data...">
                </div>
            </div>
            <div class="row row-cards" id="table-body">
                @foreach ($dosens as $dosen)
                    <div class="col-md-4 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $dosen->nama_perangkat_ajar }}</h3>
                                <div class="text-muted">
                                    <p class="mb-1"><strong>Mata Kuliah:</strong> {{ $dosen->mata_kuliah }}</p>
                                    <p class="mb-1"><strong>Semester:</strong> {{ $dosen->semester }}</p>
                                    <p class="mb-1">
                                        <strong>Tahun Ajaran:</strong>
                                        {{ $dosen->tahun_ajaran }}
                                    </p>
                                    <p class="mb-1"><strong>File:</strong> {{ $dosen->file_perangkat_ajar }}</p>
                                </div>
                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('dosen.show', $dosen->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                    <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-confirm" data-name="{{ $dosen->nama_perangkat_ajar }}">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach            </div>
            <div class="mt-3">
                {{ $dosens->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById('search-input');
                const cards = document.querySelectorAll('.col-md-4');

                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        card.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            });
        </script>
    @endpush
@endsection
