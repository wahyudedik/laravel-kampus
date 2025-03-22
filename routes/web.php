<?php

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Models\PembayaranMahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaMateriController;
use App\Http\Controllers\PembayaranMahasiswaController;

Route::get('/', function () {
    return redirect()->route('profile.edit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $totalUsers = User::count();
        $newUsers = User::whereDate('created_at', today())->count();
        $totalStudents = User::where('usertype', 'mahasiswa')->count();
        $activeStudents = DB::table('sessions')
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->where('users.usertype', 'mahasiswa')
            ->whereNotNull('sessions.last_activity')
            ->count();
        $totalTeachers = User::where('usertype', 'dosen')->count();
        $onlineTeachers = DB::table('sessions')
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->where('users.usertype', 'dosen')
            ->whereNotNull('sessions.last_activity')
            ->count();
        $totalPayments = PembayaranMahasiswa::where('status_pembayaran', true)->sum('jumlah_pembayaran');
        $newPayments = PembayaranMahasiswa::whereDate('created_at', today())->count();

        // Add these two new queries:
        $latestPayments = PembayaranMahasiswa::latest()
            ->take(5)
            ->get();

        // Get all users with their last login information
        $recentActivities = DB::table('sessions')
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->select('users.name', 'sessions.last_activity')
            ->whereNotNull('sessions.last_activity')
            ->orderBy('sessions.last_activity', 'desc')
            ->take(5)
            ->get();

        // settings 
        $settings = Setting::first();

        return view('dashboard', compact(
            'totalUsers',
            'newUsers',
            'totalStudents',
            'activeStudents',
            'totalTeachers',
            'onlineTeachers',
            'totalPayments',
            'newPayments',
            'latestPayments',
            'recentActivities',
            'settings'
        ));
    })->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // route untuk admin
    Route::resource('users', UserController::class);
    Route::resource('pembayaran-mahasiswa', PembayaranMahasiswaController::class);

    // route untuk mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('mahasiswa-materi', [MahasiswaMateriController::class, 'index'])
        ->name('mahasiswa.materi.index');
    Route::get('mahasiswa-materi/{id}/download', [MahasiswaMateriController::class, 'download'])
        ->name('mahasiswa.materi.download');


    // Route untuk dosen
    Route::resource('dosen', DosenController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::get('absensi/{id}/export-pdf', [AbsensiController::class, 'exportPdf'])->name('absensi.export-pdf');
    Route::get('absensi/{id}/export-excel', [AbsensiController::class, 'exportExcel'])->name('absensi.export-excel');

    // route untuk admin setting
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__ . '/auth.php';
