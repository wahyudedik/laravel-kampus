<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Perkuliahan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .info-table .label {
            font-weight: bold;
            width: 150px;
        }
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .attendance-table th, .attendance-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        .attendance-table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
        }
        .signature {
            float: right;
            width: 200px;
            text-align: center;
        }
        .signature .line {
            margin-top: 50px;
            border-bottom: 1px solid #000;
        }
        .summary {
            margin-top: 20px;
        }
        .summary table {
            width: 300px;
            border-collapse: collapse;
        }
        .summary table td {
            padding: 3px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR HADIR PERKULIAHAN</h1>
        <p>{{ $settings->nama_kampus ?? 'UNIVERSITAS' }}</p>
    </div>
    
    <table class="info-table">
        <tr>
            <td class="label">Mata Kuliah</td>
            <td>: {{ $absensi->mata_kuliah }}</td>
            <td class="label">Kode Kelas</td>
            <td>: {{ $absensi->kode_kelas }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td>: {{ $absensi->tanggal->format('d F Y') }}</td>
            <td class="label">Jam</td>
            <td>: {{ substr($absensi->jam_mulai, 0, 5) }} - {{ substr($absensi->jam_selesai, 0, 5) }}</td>
        </tr>
        <tr>
            <td class="label">Ruangan</td>
            <td>: {{ $absensi->ruangan }}</td>
            <td class="label">Dosen Pengajar</td>
            <td>: {{ $absensi->dosen_pengajar }}</td>
        </tr>
        <tr>
            <td class="label">Pertemuan</td>
            <td>: {{ $absensi->pertemuan }}</td>
            <td class="label">Materi</td>
            <td>: {{ $absensi->materi_perkuliahan ?? '-' }}</td>
        </tr>
    </table>
    
    <table class="attendance-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">NIM</th>
                <th width="40%">Nama Mahasiswa</th>
                <th width="15%">Status</th>
                <th width="25%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi->mahasiswas as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td style="text-align: left;">{{ $mhs->nama_mahasiswa }}</td>
                    <td>
                        @if ($mhs->status == 'hadir')
                            Hadir
                        @elseif ($mhs->status == 'izin')
                            Izin
                        @elseif ($mhs->status == 'sakit')
                            Sakit
                        @else
                            Alpa
                        @endif
                    </td>
                    <td>{{ $mhs->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="summary">
        <h4>Rekapitulasi Kehadiran:</h4>
        <table>
            <tr>
                <td>Jumlah Mahasiswa</td>
                <td>: {{ $absensi->mahasiswas->count() }} orang</td>
            </tr>
            <tr>
                <td>Hadir</td>
                <td>: {{ $absensi->mahasiswas->where('status', 'hadir')->count() }} orang</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>: {{ $absensi->mahasiswas->where('status', 'izin')->count() }} orang</td>
            </tr>
            <tr>
                <td>Sakit</td>
                <td>: {{ $absensi->mahasiswas->where('status', 'sakit')->count() }} orang</td>
            </tr>
            <tr>
                <td>Alpa</td>
                <td>: {{ $absensi->mahasiswas->where('status', 'alpa')->count() }} orang</td>
            </tr>
        </table>
    </div>
    
    <div class="footer clearfix">
        <div class="signature">
            <p>{{ $settings->kota ?? 'Kota' }}, {{ date('d F Y') }}</p>
            <p>Dosen Pengampu,</p>
            <div class="line"></div>
            <p>{{ $absensi->dosen_pengajar }}</p>
        </div>
    </div>
</body>
</html>
