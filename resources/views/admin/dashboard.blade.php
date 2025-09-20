@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Exceptions Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Exceptions</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['exceptions'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.exceptions.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    View all exceptions →
                </a>
            </div>
        </div>

        <!-- Lessons Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Lessons</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['lessons'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-book-open text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.lessons.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    View all lessons →
                </a>
            </div>
        </div>

        <!-- Teachers Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Teachers</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['teachers'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.teachers.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    View all teachers →
                </a>
            </div>
        </div>

        <!-- Courses Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Courses</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['courses'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-gray-500">Available courses</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.exceptions.create') }}"
               class="flex items-center p-4 bg-red-50 rounded-lg border border-red-200 hover:bg-red-100 transition-colors duration-200">
                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add Exception</p>
                    <p class="text-sm text-gray-600">Create a new schedule exception</p>
                </div>
            </a>

            <a href="{{ route('admin.lessons.create') }}"
               class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors duration-200">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add Lesson</p>
                    <p class="text-sm text-gray-600">Create a new lesson schedule</p>
                </div>
            </a>

            <a href="{{ route('admin.teachers.create') }}"
               class="flex items-center p-4 bg-green-50 rounded-lg border border-green-200 hover:bg-green-100 transition-colors duration-200">
                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add Teacher</p>
                    <p class="text-sm text-gray-600">Add a new teacher to the system</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity (placeholder for future enhancement) -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">System Overview</h3>
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-chart-line text-gray-400 text-2xl"></i>
            </div>
            <p class="text-gray-500">Welcome to your University Schedule Admin Panel</p>
            <p class="text-sm text-gray-400 mt-2">Manage exceptions, lessons, and teachers efficiently</p>
        </div>
    </div>
</div>
@endsection
