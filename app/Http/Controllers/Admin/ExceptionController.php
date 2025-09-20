<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exception;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExceptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Exception::with(['course', 'teacher']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('course', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'date');
        $sortDirection = $request->get('direction', 'desc');

        if ($sortBy === 'course') {
            $query->join('courses', 'exceptions.course_id', '=', 'courses.id')
                  ->orderBy('courses.name', $sortDirection)
                  ->select('exceptions.*');
        } elseif ($sortBy === 'teacher') {
            $query->join('teachers', 'exceptions.teacher_id', '=', 'teachers.id')
                  ->orderBy('teachers.name', $sortDirection)
                  ->select('exceptions.*');
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }

        $exceptions = $query->paginate(15)->withQueryString();

        return view('admin.exceptions.index', compact('exceptions'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('admin.exceptions.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'order' => 'required|integer|min:1|max:5',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Exception::create($validated);

        return redirect()->route('admin.exceptions.index')
                        ->with('success', 'Exception created successfully.');
    }

    public function edit(Exception $exception)
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('admin.exceptions.edit', compact('exception', 'courses', 'teachers'));
    }

    public function update(Request $request, Exception $exception)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'order' => 'required|integer|min:1|max:5',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $exception->update($validated);

        return redirect()->route('admin.exceptions.index')
                        ->with('success', 'Exception updated successfully.');
    }

    public function destroy(Exception $exception)
    {
        $exception->delete();

        return redirect()->route('admin.exceptions.index')
                        ->with('success', 'Exception deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No items selected.');
        }

        Exception::whereIn('id', $ids)->delete();

        return redirect()->route('admin.exceptions.index')
                        ->with('success', count($ids) . ' exceptions deleted successfully.');
    }
}
