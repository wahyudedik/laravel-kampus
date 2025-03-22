<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request) 
    {
        $request->validate([
            'icon_meta' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:1024',
            'icon_login' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'logo_dashboard' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'nama_logo_dashboard' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
        ]);

        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }

        // Handle file uploads
        if ($request->hasFile('icon_meta')) {
            if ($settings->icon_meta) {
                Storage::disk('public')->delete($settings->icon_meta);
            }
            $settings->icon_meta = $request->file('icon_meta')->store('settings', 'public');
        }

        if ($request->hasFile('icon_login')) {
            if ($settings->icon_login) {
                Storage::disk('public')->delete($settings->icon_login);
            }
            $settings->icon_login = $request->file('icon_login')->store('settings', 'public');
        }

        if ($request->hasFile('logo_dashboard')) {
            if ($settings->logo_dashboard) {
                Storage::disk('public')->delete($settings->logo_dashboard);
            }
            $settings->logo_dashboard = $request->file('logo_dashboard')->store('settings', 'public');
        }

        if ($request->filled('nama_logo_dashboard')) {
            $settings->nama_logo_dashboard = $request->nama_logo_dashboard;
        }
        
        if ($request->filled('kota')) {
            $settings->kota = $request->kota;
        }

        $settings->save();

        return redirect()->route('settings')->with('swal_success', 'Settings updated successfully!');
    }
}
