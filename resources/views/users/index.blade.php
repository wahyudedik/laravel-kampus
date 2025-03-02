@extends('layouts.app')
@section('menus', 'Manajemen Data User')
@section('page-title', 'Data User')
@section('page-subtitle', 'Manajemen data user')
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
                            <th class="sortable" data-sort="name">Nama</th>
                            <th class="sortable" data-sort="email">Email</th>
                            <th class="sortable" data-sort="usertype">Usertype</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->usertype }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-secondary no-submit-handling">
                                            Detail
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary no-submit-handling">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                data-name="{{ $user->name }}">
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
                {{ $users->links('vendor.pagination.bootstrap-5') }}
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
