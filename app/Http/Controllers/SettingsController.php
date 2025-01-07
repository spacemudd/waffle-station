<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('back.pages.settings');
    }

    public function store(Request $request)
    {
        // Save settings
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|url',
        ]);

        // Save data to the database or configuration files
        // Example:
        // Setting::updateOrCreate(['key' => 'company_name'], ['value' => $request->name]);

        return back()->with('success', 'Settings updated successfully!');
    }
}
