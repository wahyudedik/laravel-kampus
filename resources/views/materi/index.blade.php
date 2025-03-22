@extends('layouts.app')
@section('menus', 'Materi Ajar')
@section('page-title', 'Daftar Materi Ajar')
@section('page-subtitle', 'Kelola materi ajar yang telah diunggah')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('materi.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Upload Materi Baru
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
            <div class="row row-cards">
                @forelse ($materis as $materi)
                    <div class="col-md-4 col-lg-3">
                        <div class="card card-hover">
                            <div class="card-body">
                                <h3 class="card-title">{{ $materi->judul_materi }}</h3>
                                <div class="text-muted">
                                    <p class="mb-1"><strong>Mata Kuliah:</strong> {{ $materi->mata_kuliah }}</p>
                                    <p class="mb-1"><strong>Semester:</strong> {{ $materi->semester }}</p>
                                    <p class="mb-1">
                                        <strong>Tahun Ajaran:</strong>
                                        {{ $materi->tahun_ajaran->format('Y') }}/{{ $materi->tahun_ajaran->format('Y') + 1 }}
                                    </p>
                                    <p class="mb-1"><strong>File:</strong> {{ $materi->file_materi }}</p>
                                </div>
                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('materi.show', $materi->id) }}"
                                        class="btn btn-sm btn-secondary">Detail</a>
                                    <a href="{{ route('materi.edit', $materi->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-confirm"
                                            data-name="{{ $materi->judul_materi }}">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty">
                            <div class="empty-img">
                                <i class="ti ti-file-x" style="font-size: 48px;"></i>
                            </div>
                            <p class="empty-title">Belum ada materi ajar</p>
                            <p class="empty-subtitle text-muted">
                                Silakan upload materi ajar baru dengan mengklik tombol di bawah.
                            </p>
                            <div class="empty-action">
                                <a href="{{ route('materi.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i> Upload Materi Baru
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
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
