@extends('layouts.app')
@section('menus', 'Selamat Datang' . ' ' . Auth::user()->name)
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Ringkasan data dan statistik sistem')

@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('users.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Tambah User
        </a>
        <a href="{{ route('users.create') }}" class="btn btn-primary d-sm-none">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="row row-deck row-cards">
        <!-- Stats Cards Row -->
        <div class="col-sm-6 col-lg-3">
            <div class="card card-hover card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-primary text-white avatar">
                                <i class="ti ti-users"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ $totalUsers ?? 0 }} Pengguna
                            </div>
                            <div class="text-muted">
                                {{ $newUsers ?? 0 }} baru minggu ini
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-hover card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar">
                                <i class="ti ti-school"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ $totalStudents ?? 0 }} Mahasiswa
                            </div>
                            <div class="text-muted">
                                {{ $activeStudents ?? 0 }} aktif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-hover card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-twitter text-white avatar">
                                <i class="ti ti-chalkboard"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ $totalTeachers ?? 0 }} Dosen
                            </div>
                            <div class="text-muted">
                                {{ $onlineTeachers ?? 0 }} online
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-hover card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-yellow text-white avatar">
                                <i class="ti ti-report-money"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                Rp {{ number_format($totalPayments ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="text-muted">
                                {{ $newPayments ?? 0 }} pembayaran baru
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Card -->
        <div class="col-lg-8">
            <div class="card card-hover">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Ringkasan Pembayaran</h3>
                    <span class="badge bg-primary text-white">Total: Rp {{ number_format($totalPayments ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-yellow text-white avatar">
                                                <i class="ti ti-report-money"></i>
                                            </span>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-muted">Total Pembayaran Sukses</div>
                                            <div class="text-heading font-weight-bold">Rp
                                                {{ number_format($totalPayments ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-green text-white avatar">
                                                <i class="ti ti-calendar-plus"></i>
                                            </span>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-muted">Pembayaran Hari Ini</div>
                                            <div class="text-heading font-weight-bold">{{ $newPayments ?? 0 }} transaksi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Simple visual representation of payment data -->
                    <div class="mt-4">
                        <h4 class="mb-3">5 Pembayaran Terbaru</h4>
                        @forelse($latestPayments ?? [] as $payment)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <strong>{{ $payment->nama_mahasiswa }}</strong>
                                    <span>Rp {{ number_format($payment->jumlah_pembayaran ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar {{ $payment->status_pembayaran ? 'bg-success' : 'bg-warning' }}"
                                        role="progressbar"
                                        style="width: {{ min(100, ($payment->jumlah_pembayaran / max(1, $totalPayments)) * 100 * 5) }}%"
                                        aria-valuenow="{{ $payment->jumlah_pembayaran }}" aria-valuemin="0"
                                        aria-valuemax="{{ $totalPayments }}">
                                        {{ $payment->jenis_pembayaran }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                Belum ada data pembayaran
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        <!-- Recent Activity -->
        <div class="col-lg-4">
            <div class="card card-hover">
                <div class="card-header">
                    <h3 class="card-title">Aktivitas Login Terbaru</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        @forelse($recentActivities ?? [] as $activity)
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">{{ substr($activity->name ?? 'User', 0, 1) }}</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>{{ $activity->name }}</strong> login ke sistem
                                        </div>
                                        <div class="text-muted">
                                            {{ \Carbon\Carbon::createFromTimestamp($activity->last_activity)->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                <i class="ti ti-mood-empty d-block mb-2" style="font-size: 2rem;"></i>
                                Belum ada aktivitas login terbaru
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Payments -->
        <div class="col-12">
            <div class="card card-hover">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran Terbaru</h3>
                    <div class="card-actions">
                        <a href="{{ route('pembayaran-mahasiswa.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestPayments ?? [] as $payment)
                                <tr>
                                    <td>{{ $payment->nama_mahasiswa ?? 'Nama Mahasiswa' }}</td>
                                    <td>{{ $payment->nim ?? 'NIM' }}</td>
                                    <td>{{ $payment->jenis_pembayaran ?? 'Jenis Pembayaran' }}</td>
                                    <td>Rp {{ number_format($payment->jumlah_pembayaran ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $payment->tanggal_pembayaran->format('d M Y') }}</td>
                                    <td>
                                        @if ($payment->status_pembayaran ?? false)
                                            <span class="badge bg-success text-white">Terbayar</span>
                                        @else
                                            <span class="badge bg-warning text-white">Belum Terbayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pembayaran-mahasiswa.show', $payment->id ?? 1) }}"
                                            class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada data pembayaran
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Debug - check if chart container exists
            const chartContainer = document.getElementById('chart-payments');
            if (!chartContainer) {
                console.error('Chart container not found!');
                return;
            }

            // Debug - check if Chart.js is loaded
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded!');
                return;
            }

            try {
                // Get payments data safely
                const paymentsData = {!! json_encode($latestPayments ?? []) !!};
                console.log('Payment data:', paymentsData);

                if (!paymentsData || !paymentsData.length) {
                    // No data, show placeholder
                    chartContainer.innerHTML =
                        '<div class="text-center text-muted py-5">Tidak ada data pembayaran untuk ditampilkan</div>';
                    return;
                }

                // Process data for chart
                const labels = paymentsData.map(p => p.nama_mahasiswa || 'Unknown');
                const amounts = paymentsData.map(p => p.jumlah_pembayaran || 0);
                const statusColors = paymentsData.map(p => p.status_pembayaran ? 'rgba(5, 150, 105, 0.6)' :
                    'rgba(245, 158, 11, 0.6)');
                const borderColors = paymentsData.map(p => p.status_pembayaran ? 'rgb(5, 150, 105)' :
                    'rgb(245, 158, 11)');

                // Create chart
                new Chart(chartContainer, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pembayaran',
                            data: amounts,
                            backgroundColor: statusColors,
                            borderColor: borderColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error creating chart:', error);
                chartContainer.innerHTML = '<div class="text-center text-danger py-5">Error creating chart</div>';
            }
        });
    </script>
@endpush
