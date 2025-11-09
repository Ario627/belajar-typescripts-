<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Admin ProjectController
 * 
 * Resource controller untuk CRUD operations pada projects di admin dashboard.
 * Semua methods di controller ini dilindungi dengan auth middleware.
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     * 
     * Menampilkan semua projects milik user yang sedang login.
     * Include pagination dan search functionality.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query projects milik user yang sedang login
        $query = Auth::user()->projects();

        // Search functionality
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get projects dengan pagination
        // withTrashed() untuk include soft deleted projects
        $projects = $query->withTrashed()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Return admin view
        // View file: resources/views/admin/projects/index.blade.php
        return view('admin.projects.index', [
            'projects' => $projects,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new project
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return create form view
        // View file: resources/views/admin/projects/create.blade.php
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage
     * 
     * Method ini akan:
     * 1. Validate input data
     * 2. Process image upload (jika ada)
     * 3. Create project baru
     * 4. Redirect dengan success message
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'url' => 'nullable|url|max:255',
            'repository' => 'nullable|url|max:255',
            'technologies' => 'nullable|string', // Will be converted to array
            'status' => 'required|in:draft,published,archived',
            'started_at' => 'nullable|date',
            'completed_at' => 'nullable|date|after_or_equal:started_at',
            'is_featured' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Process technologies string to array
        // Input dari form: "Laravel, Vue.js, MySQL"
        // Convert jadi: ["Laravel", "Vue.js", "MySQL"]
        if (!empty($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $validated['technologies'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        // Set user_id dari authenticated user
        $validated['user_id'] = Auth::id();

        // Create project
        $project = Project::create($validated);

        // Flash success message
        session()->flash('success', 'Project berhasil dibuat!');

        // Redirect ke index page
        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified project
     * 
     * Method ini tidak digunakan dalam UI tapi tetap ada untuk completeness.
     * User bisa melihat project detail di public portfolio page.
     * 
     * @param Project $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        // Authorization: pastikan project milik user yang sedang login
        $this->authorize('view', $project);

        return view('admin.projects.show', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified project
     * 
     * @param Project $project
     * @return \Illuminate\View\View
     */
    public function edit(Project $project)
    {
        // Authorization: pastikan project milik user yang sedang login
        $this->authorize('update', $project);

        // Convert technologies array to comma-separated string untuk form
        $project->technologies_string = is_array($project->technologies) 
            ? implode(', ', $project->technologies) 
            : '';

        // Return edit form view
        // View file: resources/views/admin/projects/edit.blade.php
        return view('admin.projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified project in storage
     * 
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        // Authorization
        $this->authorize('update', $project);

        // Validasi input (sama seperti store)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url|max:255',
            'repository' => 'nullable|url|max:255',
            'technologies' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'started_at' => 'nullable|date',
            'completed_at' => 'nullable|date|after_or_equal:started_at',
            'is_featured' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Process technologies
        if (!empty($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $validated['technologies'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image jika ada
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        // Update project
        $project->update($validated);

        // Flash success message
        session()->flash('success', 'Project berhasil diupdate!');

        // Redirect ke index page
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified project from storage
     * 
     * Menggunakan soft delete, jadi data tidak benar-benar dihapus.
     * 
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        // Authorization
        $this->authorize('delete', $project);

        // Soft delete project
        $project->delete();

        // Flash success message
        session()->flash('success', 'Project berhasil dihapus!');

        // Redirect back
        return redirect()->route('admin.projects.index');
    }

    /**
     * Restore a soft deleted project
     * 
     * Bonus method untuk restore soft deleted projects.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        
        // Authorization
        $this->authorize('restore', $project);

        $project->restore();

        session()->flash('success', 'Project berhasil direstore!');

        return redirect()->route('admin.projects.index');
    }

    /**
     * Permanently delete a project
     * 
     * Bonus method untuk permanent delete (force delete).
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDestroy($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        
        // Authorization
        $this->authorize('forceDelete', $project);

        // Delete image file jika ada
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        // Permanent delete
        $project->forceDelete();

        session()->flash('success', 'Project berhasil dihapus permanen!');

        return redirect()->route('admin.projects.index');
    }
}

