<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MonitoringRpsController extends Controller
{
    public function index()
    {
        $dosens = User::where('usertype', 'dosen')
            ->withCount('perangkat_ajars')
            ->latest()
            ->paginate(10);

        return view('admin.monitoring.rps', compact('dosens'));
    }
}
