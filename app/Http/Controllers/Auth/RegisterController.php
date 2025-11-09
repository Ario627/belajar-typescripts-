<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * RegisterController
 * 
 * Controller untuk handling user registration.
 * Membuat user account baru dan otomatis login setelah register.
 */
class RegisterController extends Controller
{
    /**
     * Menampilkan registration form
     * 
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Return register view
        // View file: resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Handle user registration
     * 
     * Method ini akan:
     * 1. Validate input data
     * 2. Create user baru dengan password yang di-hash
     * 3. Auto login user yang baru register
     * 4. Redirect ke admin dashboard
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed', // password_confirmation field harus sama
                Password::min(8) // Minimal 8 karakter
                    ->letters()  // Harus ada huruf
                    ->numbers()  // Harus ada angka
            ],
        ], [
            // Custom error messages
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Create user baru
        // Password otomatis di-hash karena casting di User model
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Akan di-hash otomatis
        ]);

        // Auto login user yang baru register
        Auth::login($user);

        // Flash success message
        session()->flash('success', 'Registrasi berhasil! Selamat datang di dashboard Anda.');

        // Redirect ke admin dashboard
        return redirect()->route('admin.dashboard');
    }
}

