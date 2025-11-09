{{-- Project Form Partial - Reusable for Create & Edit --}}

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Title --}}
    <div class="md:col-span-2">
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
            Title <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               name="title" 
               id="title" 
               value="{{ old('title', $project->title ?? '') }}" 
               required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Description --}}
    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
            Short Description <span class="text-red-500">*</span>
        </label>
        <textarea name="description" 
                  id="description" 
                  rows="3" 
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Content --}}
    <div class="md:col-span-2">
        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
            Full Content
        </label>
        <textarea name="content" 
                  id="content" 
                  rows="6"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('content') border-red-500 @enderror">{{ old('content', $project->content ?? '') }}</textarea>
        @error('content')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Image --}}
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
            Project Image
        </label>
        <input type="file" 
               name="image" 
               id="image" 
               accept="image/*"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('image') border-red-500 @enderror">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @if(isset($project) && $project->image)
            <div class="mt-2">
                <img src="{{ $project->image }}" alt="Current image" class="h-20 w-auto rounded">
            </div>
        @endif
    </div>
    
    {{-- Technologies --}}
    <div>
        <label for="technologies" class="block text-sm font-medium text-gray-700 mb-2">
            Technologies (comma-separated)
        </label>
        <input type="text" 
               name="technologies" 
               id="technologies" 
               value="{{ old('technologies', $project->technologies_string ?? '') }}"
               placeholder="Laravel, Vue.js, MySQL"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('technologies') border-red-500 @enderror">
        @error('technologies')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- URL --}}
    <div>
        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
            Live URL
        </label>
        <input type="url" 
               name="url" 
               id="url" 
               value="{{ old('url', $project->url ?? '') }}"
               placeholder="https://example.com"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror">
        @error('url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Repository --}}
    <div>
        <label for="repository" class="block text-sm font-medium text-gray-700 mb-2">
            Repository URL
        </label>
        <input type="url" 
               name="repository" 
               id="repository" 
               value="{{ old('repository', $project->repository ?? '') }}"
               placeholder="https://github.com/username/repo"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('repository') border-red-500 @enderror">
        @error('repository')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Status --}}
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
            Status <span class="text-red-500">*</span>
        </label>
        <select name="status" 
                id="status" 
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
            <option value="draft" {{ old('status', $project->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status', $project->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ old('status', $project->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Order --}}
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
            Display Order
        </label>
        <input type="number" 
               name="order" 
               id="order" 
               value="{{ old('order', $project->order ?? 0) }}"
               min="0"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('order') border-red-500 @enderror">
        @error('order')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Started At --}}
    <div>
        <label for="started_at" class="block text-sm font-medium text-gray-700 mb-2">
            Started Date
        </label>
        <input type="date" 
               name="started_at" 
               id="started_at" 
               value="{{ old('started_at', isset($project->started_at) ? $project->started_at->format('Y-m-d') : '') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('started_at') border-red-500 @enderror">
        @error('started_at')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Completed At --}}
    <div>
        <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-2">
            Completed Date
        </label>
        <input type="date" 
               name="completed_at" 
               id="completed_at" 
               value="{{ old('completed_at', isset($project->completed_at) ? $project->completed_at->format('Y-m-d') : '') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('completed_at') border-red-500 @enderror">
        @error('completed_at')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    {{-- Is Featured --}}
    <div class="md:col-span-2">
        <div class="flex items-center">
            <input type="checkbox" 
                   name="is_featured" 
                   id="is_featured" 
                   value="1"
                   {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                Featured Project (will appear on homepage)
            </label>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end space-x-3">
    <a href="{{ route('admin.projects.index') }}" 
       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
        Cancel
    </a>
    <button type="submit" 
            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
        {{ isset($project) && $project->exists ? 'Update Project' : 'Create Project' }}
    </button>
</div>
