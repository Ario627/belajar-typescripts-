<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * LoginController
 * 
 * Controller untuk handling login dan logout functionality.
 * Menggunakan Laravel's built-in authentication system.
 */
class LoginController extends Controller
{
    /**
     * Menampilkan login form
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Return login view
        // View file: resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Handle login attempt
     * 
     * Method ini akan:
     * 1. Validate input (email & password)
     * 2. Attempt to authenticate user
     * 3. Regenerate session untuk security
     * 4. Redirect ke intended page atau admin dashboard
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        // Check "remember me" checkbox
        $remember = $request->filled('remember');

        // Attempt to login
        // Auth::attempt() akan:
        // 1. Cari user dengan email tersebut
        // 2. Verify password dengan bcrypt
        // 3. Jika valid, login user dan set session
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session ID untuk prevent session fixation attacks
            $request->session()->regenerate();

            // Flash success message
            session()->flash('success', 'Selamat datang kembali!');

            // Redirect ke halaman yang dimaksud sebelumnya
            // Jika tidak ada, redirect ke admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika login gagal, throw validation exception
        // Laravel akan redirect back dengan error message
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Handle logout
     * 
     * Method ini akan:
     * 1. Logout user dari session
     * 2. Invalidate session
     * 3. Regenerate CSRF token
     * 4. Redirect ke home page
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate current session
        $request->session()->invalidate();

        // Regenerate CSRF token untuk security
        $request->session()->regenerateToken();

        // Flash message
        session()->flash('success', 'Anda telah logout.');

        // Redirect ke home page
        return redirect()->route('home');
    }
}

