@extends('layouts.app')
@section('menus', 'Manajemen Data Pembayaran Mahasiswa')
@section('page-title', 'Data Pembayaran Mahasiswa')
@section('page-subtitle', 'Manajemen data pembayaran mahasiswa')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('pembayaran-mahasiswa.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Tambah Pembayaran
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <div class="form-group mb-3">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" class="form-control" id="search-input" placeholder="Cari data...">
                    </div>
                </div>
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="nama">Nama Mahasiswa</th>
                            <th class="sortable" data-sort="nim">NIM</th>
                            <th class="sortable" data-sort="jenis">Jenis Pembayaran</th>
                            <th class="sortable" data-sort="tanggal">Tanggal Pembayaran</th>
                            <th class="sortable" data-sort="jumlah">Jumlah Pembayaran</th>
                            <th class="sortable" data-sort="status">Status</th>
                            <th class="sortable" dtha-sort="bukti">Bukti Pembayaran</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($pembayaranMahasiswas as $pembayaranMahasiswa)
                            <tr>
                                <td>{{ $pembayaranMahasiswa->nama_mahasiswa }}</td>
                                <td>{{ $pembayaranMahasiswa->nim }}</td>
                                <td>{{ $pembayaranMahasiswa->jenis_pembayaran }}</td>
                                <td>{{ $pembayaranMahasiswa->tanggal_pembayaran->format('d/m/Y') }}</td>
                                <td>{{ number_format($pembayaranMahasiswa->jumlah_pembayaran, 2) }}</td>
                                <td class="{{ $pembayaranMahasiswa->status_pembayaran ? 'text-success' : 'text-danger' }}">
                                    {{ $pembayaranMahasiswa->status_pembayaran ? 'Terbayar' : 'Belum Terbayar' }}</td>
                                <td><a href="{{ asset('bukti_pembayaran/' . $pembayaranMahasiswa->bukti_pembayaran) }}"
                                        target="_blank">{{ $pembayaranMahasiswa->bukti_pembayaran }}</a></td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('pembayaran-mahasiswa.show', $pembayaranMahasiswa->id) }}"
                                            class="btn btn-sm btn-secondary no-submit-handling">
                                            Detail
                                        </a>
                                        <a href="{{ route('pembayaran-mahasiswa.edit', $pembayaranMahasiswa->id) }}"
                                            class="btn btn-sm btn-primary no-submit-handling">
                                            Edit
                                        </a>
                                        <form
                                            action="{{ route('pembayaran-mahasiswa.destroy', $pembayaranMahasiswa->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                data-name="{{ $pembayaranMahasiswa->nama_mahasiswa }}">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $pembayaranMahasiswas->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const table = document.getElementById('table-default');
                const searchInput = document.getElementById('search-input');
                const tbody = document.getElementById('table-body');
                const rows = tbody.getElementsByTagName('tr');

                // Sorting functionality
                const ths = table.getElementsByClassName('sortable');
                Array.from(ths).forEach(th => {
                    th.addEventListener('click', () => {
                        const column = th.dataset.sort;
                        const rowsArray = Array.from(rows);
                        const isAscending = th.classList.contains('asc');

                        rowsArray.sort((a, b) => {
                            const aValue = a.querySelector(
                                `td:nth-child(${Array.from(th.parentNode.children).indexOf(th) + 1})`
                            ).textContent;
                            const bValue = b.querySelector(
                                `td:nth-child(${Array.from(th.parentNode.children).indexOf(th) + 1})`
                            ).textContent;
                            return isAscending ? bValue.localeCompare(aValue) : aValue
                                .localeCompare(bValue);
                        });

                        Array.from(ths).forEach(header => header.classList.remove('asc', 'desc'));
                        th.classList.toggle('asc', !isAscending);
                        th.classList.toggle('desc', isAscending);

                        tbody.innerHTML = '';
                        rowsArray.forEach(row => tbody.appendChild(row));
                    });
                });

                // Search functionality
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    Array.from(rows).forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            });
        </script>
        <style>
            .sortable {
                cursor: pointer;
                position: relative;
            }

            .sortable:after {
                content: '↕';
                position: absolute;
                right: 8px;
                color: #999;
            }

            .sortable.asc:after {
                content: '↑';
            }

            .sortable.desc:after {
                content: '↓';
            }
        </style>
    @endpush
@endsection
