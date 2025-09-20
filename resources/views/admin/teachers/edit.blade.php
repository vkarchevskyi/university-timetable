@extends('admin.layout')

@section('title', 'Edit Teacher')
@section('page-title', 'Edit Teacher')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Edit Teacher Details</h3>
            <p class="text-sm text-gray-600 mt-1">Update the teacher information.</p>
        </div>

        <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $teacher->name }}" required
                       placeholder="Enter teacher's full name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('name') ? 'border-red-500' : '' }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.teachers.index') }}"
                   class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Update Teacher
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
