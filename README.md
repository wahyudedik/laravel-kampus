# Aplikasi Kampus Simple

## Fitur
### Landing Page
- Halaman utama aplikasi - DONE

### Login
- Sistem autentikasi pengguna - DONE

### Dashboard Admin
- CRUD User - DONE
- Detail pembayaran mahasiswa - DONE
    - id
    - user_id
    - nama_mahasiswa
    - nim
    - jenis_pembayaran
    - tanggal_pembayaran
    - jumlah_pembayaran
    - bukti_pembayaran
    - status_pembayaran
- Setting logo - Done
    - update logo - Done

### Dashboard Mahasiswa
- Input pembayaran - DONE
- Detail pembayaran - DONE
- List pembayaran - DONE
- Download materi perkuliahan - DONE

### Dashboard Dosen
- List perangkat ajar - DONE    
- Input perangkat ajar (upload file) - DONE
- Detail perangkat ajar - DONE
- Materi
    - List materi - DONE
    - Input materi (upload file) - DONE
    - Detail materi - DONE
- absensi
    - List absensi - DONE
    - Input absensi - DONE
    - Detail absensi - DONE

## Teknologi
- Laravel
- Bootstrap

## Instalasi
1. Clone repository
```
git clone https://github.com/username/aplikasi-kampus-simple.git
cd aplikasi-kampus-simple
```

2. Install dependencies
```
composer install
npm install
cp .env.example .env
php artisan key:generate --ansi
```

3. Jalankan aplikasi
```
php artisan migrate
php artisan serve
npm run dev
```

## Kontribusi
[Panduan kontribusi]

## Lisensi
[Jenis lisensi]