@extends('layouts.app')

@section('title', 'Create Project - Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Create New Project</h1>
        <p class="mt-2 text-sm text-gray-600">
            Add a new project to your portfolio
        </p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.projects._form')
        </form>
    </div>
</div>
@endsection
