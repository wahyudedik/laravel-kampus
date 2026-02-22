<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\KrsUpload;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendKrsReminders extends Command
{
    protected $signature = 'app:send-krs-reminders';
    protected $description = 'Send reminder emails to students who have not uploaded KRS';

    public function handle()
    {
        // Logika sederhana:
        // 1. Tentukan deadline (misal 2 minggu dari sekarang hardcoded atau dari setting)
        // 2. Cek apakah hari ini = deadline - 3 hari
        // 3. Ambil semua mahasiswa yang belum upload KRS
        // 4. Kirim email
        
        // Contoh implementasi dummy
        $deadline = now()->addWeeks(2);
        $reminderDate = $deadline->subDays(3);

        // Jika hari ini adalah hari reminder (untuk demo kita jalankan saja)
        
        $currentSemester = 'Ganjil';
        $currentAcademicYear = '2024/2025';

        $students = User::where('usertype', 'mahasiswa')
            ->whereDoesntHave('krs_uploads', function ($query) use ($currentSemester, $currentAcademicYear) {
                $query->where('semester', $currentSemester)
                      ->where('academic_year', $currentAcademicYear);
            })
            ->get();

        foreach ($students as $student) {
            // Mail::to($student->email)->send(new KrsReminderEmail($student));
            $this->info("Reminder sent to {$student->name} ({$student->email})");
        }

        $this->info('KRS reminders sent successfully.');
    }
}
