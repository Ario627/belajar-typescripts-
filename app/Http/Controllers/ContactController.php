<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * ContactController
 * 
 * Controller untuk halaman contact dan handling contact form submissions.
 * Menerima pesan dari visitor dan mengirim notification.
 */
class ContactController extends Controller
{
    /**
     * Menampilkan contact form
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return view contact form
        // View file: resources/views/contact.blade.php
        return view('contact');
    }

    /**
     * Memproses contact form submission
     * 
     * Method ini akan:
     * 1. Validate form data
     * 2. Log pesan untuk development (bisa diganti dengan email)
     * 3. Flash success message
     * 4. Redirect back
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validasi input dari form
        // Jika validasi gagal, Laravel otomatis redirect back dengan error messages
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            // Custom error messages (optional, untuk Indonesian language)
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subject harus diisi.',
            'message.required' => 'Pesan harus diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
        ]);

        // Log pesan untuk development/debugging
        // Di production, bisa diganti dengan send email
        Log::info('Contact form submission', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip' => $request->ip(),
            'timestamp' => now(),
        ]);

        // Alternatif: Send email notification
        // Uncomment code di bawah jika ingin send email
        /*
        try {
            Mail::send('emails.contact', $validated, function ($message) use ($validated) {
                $message->to(config('mail.admin_email', 'admin@portfolio.com'))
                        ->subject('New Contact Form: ' . $validated['subject']);
            });
        } catch (\Exception $e) {
            Log::error('Failed to send contact email: ' . $e->getMessage());
        }
        */

        // Flash success message ke session
        // Message ini bisa diakses di view dengan session('success')
        session()->flash('success', 'Terima kasih! Pesan Anda telah dikirim. Kami akan segera menghubungi Anda.');

        // Redirect kembali ke contact page
        return redirect()->route('contact');
    }
}

