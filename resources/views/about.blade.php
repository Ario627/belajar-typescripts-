{{--
    About Page
    
    Halaman informasi tentang portfolio owner.
    Bisa dikustomisasi sesuai kebutuhan.
--}}
@extends('layouts.app')

@section('title', 'About - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Page Header --}}
    <div class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">About Me</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Web Developer yang passionate dalam membangun aplikasi modern dan scalable
        </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 py-12">
        {{-- Profile Section --}}
        <div>
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Profile</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Saya adalah seorang Full Stack Web Developer dengan pengalaman dalam membangun 
                    berbagai jenis aplikasi web, dari e-commerce hingga enterprise applications. 
                    Saya memiliki passion dalam menulis clean code, mengikuti best practices, 
                    dan selalu belajar teknologi baru.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Dengan keahlian di Laravel, Vue.js, React, dan berbagai teknologi modern lainnya, 
                    saya dapat membantu mewujudkan ide Anda menjadi aplikasi web yang powerful dan 
                    user-friendly.
                </p>
                
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            admin@portfolio.com
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- Skills Section --}}
        <div>
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Technical Skills</h2>
                
                <div class="space-y-4">
                    {{-- Backend --}}
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Backend Development</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">Laravel</span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">PHP</span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">MySQL</span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">PostgreSQL</span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded">Redis</span>
                        </div>
                    </div>
                    
                    {{-- Frontend --}}
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Frontend Development</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">Vue.js</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">React</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">Alpine.js</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">Livewire</span>
                        </div>
                    </div>
                    
                    {{-- Tools & Others --}}
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Tools & Others</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded">Git</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded">Docker</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded">REST API</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded">WebSockets</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded">Elasticsearch</span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Experience Highlights --}}
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Experience Highlights</h2>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-indigo-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">E-Commerce Development</h3>
                            <p class="text-gray-600 text-sm">Built full-featured e-commerce platforms with payment integration</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-indigo-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Enterprise Applications</h3>
                            <p class="text-gray-600 text-sm">Developed scalable enterprise solutions for various industries</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-indigo-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">API Development</h3>
                            <p class="text-gray-600 text-sm">Designed and implemented RESTful APIs for mobile and web apps</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    {{-- CTA Section --}}
    <div class="text-center py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Tertarik untuk Bekerjasama?
        </h2>
        <p class="text-gray-600 mb-8">
            Mari diskusikan project Anda dan bagaimana saya bisa membantu.
        </p>
        <a href="{{ route('contact') }}" 
           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition">
            Hubungi Saya
        </a>
    </div>
</div>
@endsection
