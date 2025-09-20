<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Enums\Shared\DayOfWeek;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::with(['course', 'teacher']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('course', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'day_of_week');
        $sortDirection = $request->get('direction', 'asc');

        if ($sortBy === 'course') {
            $query->join('courses', 'lessons.course_id', '=', 'courses.id')
                  ->orderBy('courses.name', $sortDirection)
                  ->select('lessons.*');
        } elseif ($sortBy === 'teacher') {
            $query->join('teachers', 'lessons.teacher_id', '=', 'teachers.id')
                  ->orderBy('teachers.name', $sortDirection)
                  ->select('lessons.*');
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }

        $lessons = $query->paginate(15)->withQueryString();

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        $daysOfWeek = DayOfWeek::cases();

        return view('admin.lessons.create', compact('courses', 'teachers', 'daysOfWeek'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day_of_week' => 'required|integer|min:1|max:7',
            'order' => 'required|integer|min:1|max:5',
            'is_numerator' => 'nullable|boolean',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Ensure is_numerator is properly cast
        $validated['is_numerator'] = $validated['is_numerator'] ?? false;

        Lesson::create($validated);

        return redirect()->route('admin.lessons.index')
                        ->with('success', 'Lesson created successfully.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        $daysOfWeek = DayOfWeek::cases();

        return view('admin.lessons.edit', compact('lesson', 'courses', 'teachers', 'daysOfWeek'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day_of_week' => 'required|integer|min:1|max:7',
            'order' => 'required|integer|min:1|max:5',
            'is_numerator' => 'nullable|boolean',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Ensure is_numerator is properly cast
        $validated['is_numerator'] = $validated['is_numerator'] ?? false;

        $lesson->update($validated);

        return redirect()->route('admin.lessons.index')
                        ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('admin.lessons.index')
                        ->with('success', 'Lesson deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No items selected.');
        }

        Lesson::whereIn('id', $ids)->delete();

        return redirect()->route('admin.lessons.index')
                        ->with('success', count($ids) . ' lessons deleted successfully.');
    }
}
