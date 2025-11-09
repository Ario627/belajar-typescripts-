@extends('layouts.app')

@section('title', 'Edit Project - Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Project</h1>
        <p class="mt-2 text-sm text-gray-600">
            Update project: {{ $project->title }}
        </p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>
</div>
@endsection
