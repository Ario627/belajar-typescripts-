{{--
    Portfolio Show Page
    
    Halaman detail untuk satu project.
    Menampilkan informasi lengkap tentang project.
--}}
@extends('layouts.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Back Button --}}
    <div class="py-6">
        <a href="{{ route('portfolio.index') }}" 
           class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Portfolio
        </a>
    </div>
    
    {{-- Project Header --}}
    <div class="mb-8">
        @if($project->is_featured)
            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-bold rounded mb-4">
                ⭐ FEATURED PROJECT
            </span>
        @endif
        
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $project->title }}</h1>
        
        <div class="flex flex-wrap items-center gap-4 text-gray-600">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                By {{ $project->user->name }}
            </div>
            
            @if($project->started_at)
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Started {{ $project->started_at->format('F Y') }}
                </div>
            @endif
            
            @if($project->is_completed)
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Completed {{ $project->completed_at->format('F Y') }}
                </div>
            @else
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded">
                    🚧 In Progress
                </span>
            @endif
        </div>
    </div>
    
    {{-- Project Image --}}
    @if($project->image)
        <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
            <img src="{{ $project->image }}" 
                 alt="{{ $project->title }}" 
                 class="w-full h-auto max-h-96 object-cover">
        </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2">
            {{-- Description --}}
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $project->description }}
                </p>
                
                @if($project->content)
                    <div class="prose max-w-none">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Detail Project</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $project->content }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
        
        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            {{-- Technologies --}}
            @if($project->technologies && count($project->technologies) > 0)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Technologies Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            {{-- Links --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Project Links</h3>
                <div class="space-y-3">
                    @if($project->url)
                        <a href="{{ $project->url }}" 
                           target="_blank"
                           class="flex items-center text-indigo-600 hover:text-indigo-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Live Demo
                        </a>
                    @endif
                    
                    @if($project->repository)
                        <a href="{{ $project->repository }}" 
                           target="_blank"
                           class="flex items-center text-indigo-600 hover:text-indigo-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                            </svg>
                            Source Code
                        </a>
                    @endif
                    
                    @if(!$project->url && !$project->repository)
                        <p class="text-gray-500 text-sm">No external links available</p>
                    @endif
                </div>
            </div>
            
            {{-- Project Status --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Project Status</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium capitalize">{{ $project->status }}</span>
                    </div>
                    @if($project->started_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Started:</span>
                            <span class="font-medium">{{ $project->started_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                    @if($project->completed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Completed:</span>
                            <span class="font-medium">{{ $project->completed_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Related Projects --}}
    @if($relatedProjects->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedProjects as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        @if($related->image)
                            <img src="{{ $related->image }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-br from-indigo-400 to-purple-500"></div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $related->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($related->description, 100) }}</p>
                            <a href="{{ route('portfolio.show', $related) }}" 
                               class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
