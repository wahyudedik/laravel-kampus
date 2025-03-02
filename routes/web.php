<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\PembayaranMahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
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
            'recentActivities'
        ));
    })->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('users', UserController::class);
    Route::resource('pembayaran-mahasiswa', PembayaranMahasiswaController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
});

require __DIR__ . '/auth.php';
