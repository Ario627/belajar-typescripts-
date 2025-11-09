@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-indigo-600">404</h1>
            <h2 class="mt-4 text-3xl font-bold text-gray-900">Page Not Found</h2>
            <p class="mt-2 text-gray-600">
                Halaman yang Anda cari tidak ditemukan.
            </p>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Back to Home
            </a>
            <a href="{{ route('portfolio.index') }}" 
               class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                View Portfolio
            </a>
        </div>
    </div>
</div>
@endsection
