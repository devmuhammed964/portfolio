<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Ayrı İletişim Sayfası
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('contact', compact('settings'));
    }

    // Form Gönderimi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
        ]);

        return back()->with(
            'success',
            __('contact_form.success')
        );
    }
}