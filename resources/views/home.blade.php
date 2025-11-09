{{--
    Home Page
    
    Halaman utama portfolio yang menampilkan featured projects.
    Extends dari layout master dan menggunakan @section untuk content.
--}}
@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Hero Section --}}
    <div class="text-center py-12 md:py-20">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-4">
            Selamat Datang di Portfolio Saya
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Showcase berbagai project web development, dari e-commerce hingga aplikasi enterprise.
            Dibangun dengan teknologi modern dan best practices.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('portfolio.index') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition">
                Lihat Portfolio
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                Hubungi Saya
            </a>
        </div>
    </div>
    
    {{-- Featured Projects Section --}}
    @if($featuredProjects->count() > 0)
        <div class="py-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Projects</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Beberapa project unggulan yang telah dikerjakan
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Loop through featured projects --}}
                @foreach($featuredProjects as $project)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        {{-- Project Image --}}
                        @if($project->image)
                            <img src="{{ $project->image }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-2xl font-bold">{{ substr($project->title, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        {{-- Project Info --}}
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $project->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">
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
                                            +{{ count($project->technologies) - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            @endif
                            
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
            
            {{-- View All Projects Button --}}
            <div class="text-center mt-12">
                <a href="{{ route('portfolio.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Lihat Semua Project
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    @else
        {{-- No featured projects message --}}
        <div class="text-center py-12">
            <p class="text-gray-600 text-lg">Belum ada featured projects untuk ditampilkan.</p>
        </div>
    @endif
    
    {{-- CTA Section --}}
    <div class="bg-indigo-700 rounded-lg shadow-xl my-16 p-12 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Tertarik untuk Berkolaborasi?
        </h2>
        <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
            Mari berdiskusi tentang project Anda dan bagaimana saya bisa membantu mewujudkannya.
        </p>
        <a href="{{ route('contact') }}" 
           class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-50 transition">
            Hubungi Sekarang
        </a>
    </div>
</div>
@endsection
