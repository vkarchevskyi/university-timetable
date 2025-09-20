@extends('admin.layout')

@section('title', 'Edit Lesson')
@section('page-title', 'Edit Lesson')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Edit Lesson Details</h3>
            <p class="text-sm text-gray-600 mt-1">Update the lesson information.</p>
        </div>

        <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Course Selection -->
            <div>
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Course <span class="text-red-500">*</span>
                </label>
                <select name="course_id" id="course_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('course_id') ? 'border-red-500' : '' }}">
                    <option value="">Select a course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ (old('course_id') ?? $lesson->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Day of Week -->
            <div>
                <label for="day_of_week" class="block text-sm font-medium text-gray-700 mb-2">
                    Day of Week <span class="text-red-500">*</span>
                </label>
                <select name="day_of_week" id="day_of_week" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('day_of_week') ? 'border-red-500' : '' }}">
                    <option value="">Select day of week</option>
                    @foreach($daysOfWeek as $day)
                        <option value="{{ $day->value }}" {{ (old('day_of_week') ?? $lesson->day_of_week->value) == $day->value ? 'selected' : '' }}>
                            {{ $day->getRichLabel() }}
                        </option>
                    @endforeach
                </select>
                @error('day_of_week')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    Lesson Order <span class="text-red-500">*</span>
                </label>
                <select name="order" id="order" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('order') ? 'border-red-500' : '' }}">
                    <option value="">Select lesson order</option>
                    <option value="1" {{ (old('order') ?? $lesson->order->value) == '1' ? 'selected' : '' }}>1st Lesson</option>
                    <option value="2" {{ (old('order') ?? $lesson->order->value) == '2' ? 'selected' : '' }}>2nd Lesson</option>
                    <option value="3" {{ (old('order') ?? $lesson->order->value) == '3' ? 'selected' : '' }}>3rd Lesson</option>
                    <option value="4" {{ (old('order') ?? $lesson->order->value) == '4' ? 'selected' : '' }}>4th Lesson</option>
                    <option value="5" {{ (old('order') ?? $lesson->order->value) == '5' ? 'selected' : '' }}>5th Lesson</option>
                </select>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Numerator -->
            <div>
                <label for="is_numerator" class="block text-sm font-medium text-gray-700 mb-2">
                    Numerator Week
                </label>
                <div class="flex items-center">
                    <input type="hidden" name="is_numerator" value="0">
                    <input type="checkbox" name="is_numerator" id="is_numerator" value="1"
                           {{ (old('is_numerator') ?? $lesson->is_numerator) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="is_numerator" class="ml-2 text-sm text-gray-600">
                        This lesson occurs during numerator weeks
                    </label>
                </div>
                @error('is_numerator')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teacher Selection -->
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Teacher <span class="text-red-500">*</span>
                </label>
                <select name="teacher_id" id="teacher_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('teacher_id') ? 'border-red-500' : '' }}">
                    <option value="">Select a teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ (old('teacher_id') ?? $lesson->teacher_id) == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.lessons.index') }}"
                   class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Update Lesson
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
