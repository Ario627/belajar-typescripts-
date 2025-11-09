{{--
    Admin Dashboard
    
    Dashboard utama untuk admin panel.
    Menampilkan statistik dan quick links.
--}}
@extends('layouts.app')

@section('title', 'Admin Dashboard - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>
    
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-900">{{ auth()->user()->projects()->count() }}</p>
                </div>
                <div class="bg-indigo-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Published</p>
                    <p class="text-3xl font-bold text-green-600">{{ auth()->user()->projects()->where('status', 'published')->count() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Draft</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ auth()->user()->projects()->where('status', 'draft')->count() }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Quick Actions --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.projects.create') }}" 
               class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">New Project</p>
                    <p class="text-sm text-gray-600">Create project</p>
                </div>
            </a>
            
            <a href="{{ route('admin.projects.index') }}" 
               class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">All Projects</p>
                    <p class="text-sm text-gray-600">Manage projects</p>
                </div>
            </a>
            
            <a href="{{ route('portfolio.index') }}" 
               class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">View Portfolio</p>
                    <p class="text-sm text-gray-600">Public view</p>
                </div>
            </a>
            
            <a href="{{ route('home') }}" 
               class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">Homepage</p>
                    <p class="text-sm text-gray-600">Visit site</p>
                </div>
            </a>
        </div>
    </div>
    
    {{-- Recent Projects --}}
    @php
        $recentProjects = auth()->user()->projects()->latest()->take(5)->get();
    @endphp
    
    @if($recentProjects->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Projects</h2>
            <div class="space-y-4">
                @foreach($recentProjects as $project)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $project->title }}</h3>
                            <div class="flex items-center mt-1 text-sm text-gray-600">
                                <span class="px-2 py-1 bg-{{ $project->status === 'published' ? 'green' : ($project->status === 'draft' ? 'yellow' : 'gray') }}-100 text-{{ $project->status === 'published' ? 'green' : ($project->status === 'draft' ? 'yellow' : 'gray') }}-800 text-xs rounded mr-2">
                                    {{ ucfirst($project->status) }}
                                </span>
                                <span>{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.projects.edit', $project) }}" 
                           class="ml-4 text-indigo-600 hover:text-indigo-800 font-medium">
                            Edit
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('admin.projects.index') }}" 
                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                    View All Projects →
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
