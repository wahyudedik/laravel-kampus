@extends('layouts.app')

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
                <div class="card-header">
                    <h3 class="card-title">Grafik Pembayaran</h3>
                </div>
                <div class="card-body">
                    <div id="chart-payments" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4">
            <div class="card card-hover">
                <div class="card-header">
                    <h3 class="card-title">Aktivitas Terbaru</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        @forelse($recentActivities ?? [] as $activity)
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">{{ substr($activity->user->name ?? 'User', 0, 1) }}</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            {{ $activity->description ?? 'Activity description' }}
                                        </div>
                                        <div class="text-muted">{{ $activity->created_at ?? now()->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                <i class="ti ti-mood-empty d-block mb-2" style="font-size: 2rem;"></i>
                                Belum ada aktivitas terbaru
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
                        <a href="#" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Mahasiswa</th>
                                <th>Jenis Pembayaran</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestPayments ?? [] as $payment)
                                <tr>
                                    <td>{{ $payment->student->name ?? 'Nama Mahasiswa' }}</td>
                                    <td>{{ $payment->type ?? 'Jenis Pembayaran' }}</td>
                                    <td>Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $payment->created_at ?? now()->format('d M Y') }}</td>
                                    <td>
                                        @if (($payment->status ?? 'pending') === 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif(($payment->status ?? 'pending') === 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.payments.show', $payment->id ?? 1) }}"
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
            // Sample data for chart
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const sampleData = [30, 45, 32, 70, 40, 60, 80, 65, 55, 70, 60, 80];

            // Initialize payments chart
            const ctx = document.getElementById('chart-payments');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Pembayaran Bulanan',
                            tension: 0.3,
                            data: sampleData,
                            borderColor: '#206bc4',
                            backgroundColor: 'rgba(32, 107, 196, 0.1)',
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
