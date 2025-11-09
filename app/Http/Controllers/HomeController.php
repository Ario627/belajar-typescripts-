<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

/**
 * HomeController
 * 
 * Controller untuk halaman utama/home dari website portfolio.
 * Menampilkan featured projects dan informasi umum.
 */
class HomeController extends Controller
{
    /**
     * Menampilkan halaman home
     * 
     * Method ini akan:
     * 1. Mengambil projects yang featured dan published
     * 2. Limit hanya 6 projects terbaru
     * 3. Ordered by custom order field
     * 4. Pass data ke view 'home'
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Query untuk mendapatkan featured projects
        // - published(): scope untuk filter status='published'
        // - featured(): scope untuk filter is_featured=true
        // - ordered(): scope untuk sort by order field
        // - latest(): sort by created_at DESC
        // - take(6): limit hanya 6 results
        $featuredProjects = Project::published()
            ->featured()
            ->ordered()
            ->latest()
            ->take(6)
            ->get();

        // Return view dengan data projects
        // View file: resources/views/home.blade.php
        return view('home', [
            'featuredProjects' => $featuredProjects,
        ]);
    }
}

