 @extends('layouts.app')
@section('menus', 'Manajemen Data Pembayaran Mahasiswa' . ' ' . Auth::user()->name)
 @section('page-title', 'Detail Pembayaran Mahasiswa')
 @section('page-subtitle', 'Informasi lengkap pembayaran mahasiswa')
 @section('page-actions')
     <div class="btn-list">
         <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
             <i class="ti ti-arrow-left"></i> Kembali
         </a>
     </div>
 @endsection
 @section('content')
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">Detail Pengguna</h3>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-md-4 mb-3">
                     <div class="d-flex flex-column align-items-center">
                         <div class="avatar avatar-xl mb-3">
                             <span class="avatar-text rounded-circle bg-primary-lt">
                                 {{ strtoupper(substr($pembayaranMahasiswa->nama_mahasiswa, 0, 2)) }}
                             </span>
                         </div>
                         <h4>{{ $pembayaranMahasiswa->nama_mahasiswa }}</h4>
                         <span
                             class="badge bg-{{ $pembayaranMahasiswa->status_pembayaran ? 'success text-white' : 'warning text-white' }}">
                             {{ $pembayaranMahasiswa->status_pembayaran ? 'Terbayar' : 'Belum Terbayar' }}
                         </span>
                     </div>
                 </div>
                 <div class="col-md-8">
                     <div class="table-responsive">
                         <table class="table table-vcenter">
                             <tbody>
                                 <tr>
                                     <td class="text-muted">Nama Mahasiswa</td>
                                     <td>{{ $pembayaranMahasiswa->nama_mahasiswa }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">NIM</td>
                                     <td>{{ $pembayaranMahasiswa->nim }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Jenis Pembayaran</td>
                                     <td>{{ $pembayaranMahasiswa->jenis_pembayaran }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Tanggal Pembayaran</td>
                                     <td>{{ $pembayaranMahasiswa->tanggal_pembayaran->format('d M Y') }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Jumlah Pembayaran</td>
                                     <td>Rp {{ number_format($pembayaranMahasiswa->jumlah_pembayaran, 2, ',', '.') }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Status Pembayaran</td>
                                     <td>
                                         <span
                                             class="badge bg-{{ $pembayaranMahasiswa->status_pembayaran ? 'success text-white' : 'warning text-white' }}">
                                             {{ $pembayaranMahasiswa->status_pembayaran ? 'Terbayar' : 'Belum Terbayar' }}
                                         </span>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Keterangan</td>
                                     <td>{{ $pembayaranMahasiswa->keterangan }}</td>
                                 </tr>
                                 <tr>
                                     <td class="text-muted">Bukti Pembayaran</td>
                                     <td>
                                         @if ($pembayaranMahasiswa->bukti_pembayaran)
                                             <a href="{{ asset('bukti_pembayaran/' . $pembayaranMahasiswa->bukti_pembayaran) }}"
                                                 target="_blank">Lihat Bukti</a>
                                         @else
                                             <span class="text-muted">Belum ada bukti pembayaran</span>
                                         @endif
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>

         <div class="card-footer">
             <div class="d-flex justify-content-between">
                 <a href="{{ route('pembayaran-mahasiswa.index') }}" class="btn btn-outline-secondary">
                     <i class="ti ti-arrow-left"></i> Kembali
                 </a>
             </div>
         </div>

         <!-- Riwayat Pembayaran Section -->
         <div class="card mt-4">
             <div class="card-header">
                 <h3 class="card-title">Riwayat Pembayaran</h3>
                 <div class="card-actions">
                     <span class="badge bg-primary text-white">Total: {{ $pembayaranMahasiswaAll->count() }}
                         Pembayaran</span>
                 </div>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-vcenter table-hover">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Tanggal</th>
                                 <th>Jenis Pembayaran</th>
                                 <th>Jumlah</th>
                                 <th>Status</th>
                                 <th>Bukti</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse ($pembayaranMahasiswaAll as $index => $pembayaran)
                                 <tr class="{{ $pembayaran->id == $pembayaranMahasiswa->id ? 'bg-light' : '' }}">
                                     <td>{{ $index + 1 }}</td>
                                     <td>{{ $pembayaran->tanggal_pembayaran->format('d M Y') }}</td>
                                     <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                     <td>Rp {{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                                     <td>
                                         <span
                                             class="badge bg-{{ $pembayaran->status_pembayaran ? 'success text-white' : 'warning text-white' }}">
                                             {{ $pembayaran->status_pembayaran ? 'Terbayar' : 'Belum Terbayar' }}
                                         </span>
                                     </td>
                                     <td>
                                         @if ($pembayaran->bukti_pembayaran)
                                             <a href="{{ asset('bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                                                 target="_blank" class="btn btn-sm btn-outline-primary">
                                                 <i class="ti ti-eye"></i>
                                             </a>
                                         @else
                                             <span class="text-muted">-</span>
                                         @endif
                                     </td>
                                     <td>
                                         <div class="btn-list">
                                             <a href="{{ route('pembayaran-mahasiswa.show', $pembayaran->id) }}"
                                                 class="btn btn-sm btn-outline-info">
                                                 <i class="ti ti-info-circle"></i>
                                             </a>
                                             <a href="{{ route('pembayaran-mahasiswa.edit', $pembayaran->id) }}"
                                                 class="btn btn-sm btn-outline-primary">
                                                 <i class="ti ti-edit"></i>
                                             </a>
                                         </div>
                                     </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="7" class="text-center">Tidak ada data pembayaran</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class="card-footer">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <span class="text-muted">Total Pembayaran:</span>
                         <strong class="ms-2">Rp
                             {{ number_format($pembayaranMahasiswaAll->sum('jumlah_pembayaran'), 2, ',', '.') }}</strong>
                     </div>
                     <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                         <i class="ti ti-plus"></i> Tambah Pembayaran Baru
                     </a>
                 </div>
             </div>
         </div>
     @endsection
