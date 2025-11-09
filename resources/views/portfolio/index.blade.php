{{--
    Portfolio Index Page
    
    Halaman listing semua portfolio projects.
    Include pagination dan search functionality.
--}}
@extends('layouts.app')

@section('title', 'Portfolio - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Page Header with Search --}}
    <div class="py-12">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Portfolio</h1>
                <p class="text-lg text-gray-600">
                    Koleksi project yang telah dikerjakan
                </p>
            </div>
            
            {{-- Search Form --}}
            <div class="mt-4 md:mt-0 md:ml-4">
                <form action="{{ route('portfolio.index') }}" method="GET" class="flex">
                    <input type="text" 
                           name="search" 
                           value="{{ $search ?? '' }}" 
                           placeholder="Cari projects..."
                           class="px-4 py-2 border border-gray-300 rounded-l-md focus:ring-indigo-500 focus:border-indigo-500 w-64">
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Results Info --}}
    @if($search)
        <div class="mb-8">
            <p class="text-gray-600">
                Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong>
                <a href="{{ route('portfolio.index') }}" class="text-indigo-600 hover:text-indigo-800 ml-2">
                    (Clear search)
                </a>
            </p>
        </div>
    @endif
    
    {{-- Projects Grid --}}
    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($projects as $project)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    {{-- Project Image --}}
                    @if($project->image)
                        <img src="{{ $project->image }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-3xl font-bold">{{ substr($project->title, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    {{-- Project Info --}}
                    <div class="p-6">
                        {{-- Featured Badge --}}
                        @if($project->is_featured)
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded mb-2">
                                ⭐ FEATURED
                            </span>
                        @endif
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $project->title }}
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $project->excerpt }}
                        </p>
                        
                        {{-- Technologies --}}
                        @if($project->technologies && count($project->technologies) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if(count($project->technologies) > 3)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">
                                        +{{ count($project->technologies) - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        
                        {{-- Status & Date --}}
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>
                                @if($project->is_completed)
                                    ✓ Completed
                                @else
                                    🚧 In Progress
                                @endif
                            </span>
                            @if($project->completed_at)
                                <span>{{ $project->completed_at->format('M Y') }}</span>
                            @endif
                        </div>
                        
                        {{-- View Details Button --}}
                        <a href="{{ route('portfolio.show', $project) }}" 
                           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Detail
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        <div class="py-8">
            {{ $projects->links() }}
        </div>
    @else
        {{-- No Results --}}
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada projects</h3>
            <p class="mt-1 text-gray-500">
                @if($search)
                    Tidak ditemukan projects yang cocok dengan pencarian Anda.
                @else
                    Belum ada projects untuk ditampilkan.
                @endif
            </p>
            @if($search)
                <div class="mt-6">
                    <a href="{{ route('portfolio.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Lihat Semua Projects
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
