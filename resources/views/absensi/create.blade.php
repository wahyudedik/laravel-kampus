@extends('layouts.app')
@section('menus', 'Absensi Mahasiswa')
@section('page-title', 'Buat Absensi Baru')
@section('page-subtitle', 'Form input absensi mahasiswa')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Absensi Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.store') }}" method="POST" id="absensiForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" class="form-control @error('mata_kuliah') is-invalid @enderror" value="{{ old('mata_kuliah') }}" required>
                            @error('mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Kode Kelas</label>
                            <input type="text" name="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror" value="{{ old('kode_kelas') }}" required>
                            @error('kode_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Ruangan</label>
                            <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror" value="{{ old('ruangan') }}" required>
                            @error('ruangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Dosen Pengajar</label>
                            <input type="text" name="dosen_pengajar" class="form-control @error('dosen_pengajar') is-invalid @enderror" value="{{ old('dosen_pengajar') }}" required>
                            @error('dosen_pengajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Pertemuan</label>
                            <select name="pertemuan" class="form-select @error('pertemuan') is-invalid @enderror" required>
                                <option value="">Pilih Pertemuan</option>
                                @for ($i = 1; $i <= 16; $i++)
                                    <option value="Pertemuan {{ $i }}" {{ old('pertemuan') == "Pertemuan $i" ? 'selected' : '' }}>Pertemuan {{ $i }}</option>
                                @endfor
                            </select>
                            @error('pertemuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Materi Perkuliahan</label>
                            <textarea name="materi_perkuliahan" class="form-control @error('materi_perkuliahan') is-invalid @enderror" rows="3">{{ old('materi_perkuliahan') }}</textarea>
                            @error('materi_perkuliahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <h3>Data Kehadiran Mahasiswa</h3>
                <p class="text-muted">Masukkan data kehadiran mahasiswa untuk mata kuliah ini</p>

                <div id="mahasiswa-container">
                    <div class="mahasiswa-item mb-3 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label required">NIM</label>
                                    <input type="text" name="mahasiswa[0][nim]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label required">Nama Mahasiswa</label>
                                    <input type="text" name="mahasiswa[0][nama]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label required">Status</label>
                                    <select name="mahasiswa[0][status]" class="form-select" required>
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpa">Alpa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" name="mahasiswa[0][keterangan]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger remove-mahasiswa mt-2" style="display: none;">
                            <i class="ti ti-trash"></i> Hapus
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="button" class="btn btn-success" id="add-mahasiswa">
                        <i class="ti ti-plus"></i> Tambah Mahasiswa
                    </button>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let mahasiswaCount = 0;
        
        // Fungsi untuk menambah form mahasiswa
        document.getElementById('add-mahasiswa').addEventListener('click', function() {
            mahasiswaCount++;
            const container = document.getElementById('mahasiswa-container');
            const newItem = document.createElement('div');
            newItem.className = 'mahasiswa-item mb-3 p-3 border rounded';
            newItem.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label required">NIM</label>
                            <input type="text" name="mahasiswa[${mahasiswaCount}][nim]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label required">Nama Mahasiswa</label>
                            <input type="text" name="mahasiswa[${mahasiswaCount}][nama]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label required">Status</label>
                            <select name="mahasiswa[${mahasiswaCount}][status]" class="form-select" required>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="alpa">Alpa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="mahasiswa[${mahasiswaCount}][keterangan]" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger remove-mahasiswa mt-2">
                    <i class="ti ti-trash"></i> Hapus
                </button>
            `;
            container.appendChild(newItem);
            
            // Tampilkan tombol hapus pada item pertama jika sudah ada item lain
            if (mahasiswaCount === 1) {
                document.querySelector('.mahasiswa-item .remove-mahasiswa').style.display = 'inline-block';
            }
        });
        
        // Event delegation untuk tombol hapus
        document.getElementById('mahasiswa-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-mahasiswa') || e.target.closest('.remove-mahasiswa')) {
                const item = e.target.closest('.mahasiswa-item');
                item.remove();
                
                // Sembunyikan tombol hapus pada item pertama jika hanya ada satu item
                const items = document.querySelectorAll('.mahasiswa-item');
                if (items.length === 1) {
                    items[0].querySelector('.remove-mahasiswa').style.display = 'none';
                }
                
                // Reindex form fields untuk menghindari gap dalam array
                reindexMahasiswaFields();
            }
        });
        
        // Fungsi untuk mengindeks ulang field mahasiswa
        function reindexMahasiswaFields() {
            const items = document.querySelectorAll('.mahasiswa-item');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/mahasiswa\[\d+\]/, `mahasiswa[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
            mahasiswaCount = items.length - 1;
        }
    });
</script>
@endpush
