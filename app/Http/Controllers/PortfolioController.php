<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

/**
 * PortfolioController
 * 
 * Controller untuk halaman portfolio/projects.
 * Menampilkan listing dan detail dari portfolio projects.
 */
class PortfolioController extends Controller
{
    /**
     * Menampilkan listing semua projects dengan pagination
     * 
     * Method ini akan:
     * 1. Mengambil semua published projects
     * 2. Support search functionality
     * 3. Implement pagination (9 items per page)
     * 4. Ordered by custom order field
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Mulai query untuk get published projects
        $query = Project::published();

        // Jika ada search query parameter
        // Filter projects berdasarkan title atau description
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Execute query dengan pagination
        // paginate(9) akan return 9 items per page
        // Laravel otomatis handle page number dari query string ?page=2
        $projects = $query->ordered()
            ->latest()
            ->paginate(9)
            ->withQueryString(); // Preserve query string di pagination links

        // Return view dengan data
        // View file: resources/views/portfolio/index.blade.php
        return view('portfolio.index', [
            'projects' => $projects,
            'search' => $search,
        ]);
    }

    /**
     * Menampilkan detail dari satu project
     * 
     * Method ini menggunakan route model binding.
     * Laravel akan otomatis find project by ID dari URL.
     * Jika tidak found, akan throw 404 error.
     * 
     * @param Project $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        // Cek apakah project sudah published
        // Jika belum, return 404 (untuk security, draft tidak boleh diakses public)
        if ($project->status !== 'published') {
            abort(404);
        }

        // Load relasi user untuk ditampilkan di detail page
        // Menggunakan lazy eager loading
        $project->load('user');

        // Get related projects (projects lain dari user yang sama)
        // Exclude project yang sedang dilihat
        // Limit 3 projects
        $relatedProjects = Project::published()
            ->where('user_id', $project->user_id)
            ->where('id', '!=', $project->id)
            ->ordered()
            ->latest()
            ->take(3)
            ->get();

        // Return view dengan data
        // View file: resources/views/portfolio/show.blade.php
        return view('portfolio.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
        ]);
    }
}

