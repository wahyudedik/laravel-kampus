@extends('layouts.app')
@section('menus', 'Absensi Mahasiswa')
@section('page-title', 'Edit Absensi')
@section('page-subtitle', 'Form edit absensi mahasiswa')
@section('page-actions')
    <div class="btn-list">
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('absensi.show', $absensi->id) }}" class="btn btn-info d-none d-sm-inline-block">
            <i class="ti ti-eye"></i> Lihat Detail
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Absensi Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.update', $absensi->id) }}" method="POST" id="absensiForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" class="form-control @error('mata_kuliah') is-invalid @enderror" value="{{ old('mata_kuliah', $absensi->mata_kuliah) }}" required>
                            @error('mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Kode Kelas</label>
                            <input type="text" name="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror" value="{{ old('kode_kelas', $absensi->kode_kelas) }}" required>
                            @error('kode_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $absensi->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', $absensi->jam_mulai) }}" required>
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', $absensi->jam_selesai) }}" required>
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Ruangan</label>
                            <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror" value="{{ old('ruangan', $absensi->ruangan) }}" required>
                            @error('ruangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Dosen Pengajar</label>
                            <input type="text" name="dosen_pengajar" class="form-control @error('dosen_pengajar') is-invalid @enderror" value="{{ old('dosen_pengajar', $absensi->dosen_pengajar) }}" required>
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
                                    <option value="Pertemuan {{ $i }}" {{ old('pertemuan', $absensi->pertemuan) == "Pertemuan $i" ? 'selected' : '' }}>Pertemuan {{ $i }}</option>
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
                            <textarea name="materi_perkuliahan" class="form-control @error('materi_perkuliahan') is-invalid @enderror" rows="3">{{ old('materi_perkuliahan', $absensi->materi_perkuliahan) }}</textarea>
                            @error('materi_perkuliahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <h3>Data Kehadiran Mahasiswa</h3>
                <p class="text-muted">Edit data kehadiran mahasiswa untuk mata kuliah ini</p>

                <div id="mahasiswa-container">
                    @foreach ($absensi->mahasiswas as $index => $mhs)
                        <div class="mahasiswa-item mb-3 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label required">NIM</label>
                                        <input type="hidden" name="mahasiswa[{{ $index }}][id]" value="{{ $mhs->id }}">
                                        <input type="text" name="mahasiswa[{{ $index }}][nim]" class="form-control" value="{{ $mhs->nim }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label required">Nama Mahasiswa</label>
                                        <input type="text" name="mahasiswa[{{ $index }}][nama]" class="form-control" value="{{ $mhs->nama_mahasiswa }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label required">Status</label>
                                        <select name="mahasiswa[{{ $index }}][status]" class="form-select" required>
                                            <option value="hadir" {{ $mhs->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="izin" {{ $mhs->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                            <option value="sakit" {{ $mhs->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                            <option value="alpa" {{ $mhs->status == 'alpa' ? 'selected' : '' }}>Alpa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" name="mahasiswa[{{ $index }}][keterangan]" class="form-control" value="{{ $mhs->keterangan }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-mahasiswa mt-2" {{ $absensi->mahasiswas->count() <= 1 ? 'style=display:none' : '' }}>
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <button type="button" class="btn btn-success" id="add-mahasiswa">
                        <i class="ti ti-plus"></i> Tambah Mahasiswa
                    </button>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Perbarui Absensi</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let mahasiswaCount = {{ $absensi->mahasiswas->count() - 1 }};
        
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
            
            // Tampilkan tombol hapus pada semua item jika ada lebih dari satu
            if (document.querySelectorAll('.mahasiswa-item').length > 1) {
                document.querySelectorAll('.mahasiswa-item .remove-mahasiswa').forEach(btn => {
                    btn.style.display = 'inline-block';
                });
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
                    if (name && name.match(/mahasiswa\[\d+\]/)) {
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
