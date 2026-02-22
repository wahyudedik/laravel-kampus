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
            'logo_1' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_2' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_3' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_4' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'ig_1' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'link_ig_1' => 'nullable|string|max:255',
            'ig_2' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'link_ig_2' => 'nullable|string|max:255',
            'logo_website' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'link_website' => 'nullable|string|max:255',
            'krs_deadline' => 'nullable|date',
        ]);

        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }

        // Handle file uploads
        foreach (['icon_meta', 'icon_login', 'logo_dashboard', 'logo_1', 'logo_2', 'logo_3', 'logo_4', 'ig_1', 'ig_2', 'logo_website'] as $field) {
            if ($request->hasFile($field)) {
                if ($settings->$field) {
                    Storage::disk('public')->delete($settings->$field);
                }
                $settings->$field = $request->file($field)->store('settings', 'public');
            }
        }

        if ($request->filled('nama_logo_dashboard')) {
            $settings->nama_logo_dashboard = $request->nama_logo_dashboard;
        }
        
        if ($request->filled('kota')) {
            $settings->kota = $request->kota;
        }

        if ($request->filled('link_ig_1')) $settings->link_ig_1 = $request->link_ig_1;
        if ($request->filled('link_ig_2')) $settings->link_ig_2 = $request->link_ig_2;
        if ($request->filled('link_website')) $settings->link_website = $request->link_website;
        
        if ($request->filled('krs_deadline')) {
            $settings->krs_deadline = $request->krs_deadline;
        }

        $settings->save();

        return redirect()->route('settings')->with('swal_success', 'Settings updated successfully!');
    }
}
