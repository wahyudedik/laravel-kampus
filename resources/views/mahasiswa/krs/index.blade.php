@extends('layouts.app')

@section('menus', 'Kartu Rencana Studi (KRS)')
@section('page-title', 'Upload KRS')
@section('page-subtitle', 'Upload dan pantau status KRS Anda')

@section('content')
<div class="row row-cards">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Countdown Batas Akhir</h3>
            </div>
            <div class="card-body text-center">
                @if($settings && $settings->krs_deadline)
                    <div id="countdown" class="display-5 fw-bold mb-3"></div>
                    <div class="text-muted">Batas Akhir Upload: {{ \Carbon\Carbon::parse($settings->krs_deadline)->format('d F Y H:i') }}</div>
                @else
                    <div class="text-muted">Batas akhir belum ditentukan</div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Status KRS Semester {{ $currentSemester }} {{ $currentAcademicYear }}</h3>
            </div>
            <div class="card-body">
                @if($krs)
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="ti ti-check me-2 fs-2"></i>
                        <div>
                            KRS Anda berhasil diupload pada {{ $krs->upload_date->format('d F Y H:i') }}.
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $krs->file_path) }}" target="_blank" class="btn btn-sm btn-light">Lihat File</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <i class="ti ti-alert-triangle me-2"></i>
                        Anda belum mengupload KRS untuk semester ini.
                    </div>

                    <form action="{{ route('mahasiswa.krs.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <input type="hidden" name="semester" value="{{ $currentSemester }}">
                        <input type="hidden" name="academic_year" value="{{ $currentAcademicYear }}">
                        
                        <div class="mb-3">
                            <label class="form-label required">File KRS (PDF/Image, Max 2MB)</label>
                            <input type="file" class="form-control @error('file_krs') is-invalid @enderror" name="file_krs" accept=".pdf,.jpg,.jpeg,.png" required>
                            @error('file_krs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-upload me-2"></i> Upload KRS
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    @if($settings && $settings->krs_deadline)
    // Countdown Timer from database
    const deadline = new Date("{{ $settings->krs_deadline }}");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = deadline - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        const countdownEl = document.getElementById("countdown");
        if (countdownEl) {
            if (distance < 0) {
                countdownEl.innerHTML = "EXPIRED";
                countdownEl.classList.add('text-danger');
            } else {
                countdownEl.innerHTML = days + "d " + hours + "h " + minutes + "m ";
            }
        }
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
    @endif
</script>
@endsection
