<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exception;
use App\Models\Lesson;
use App\Models\Teacher;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'exceptions' => Exception::count(),
            'lessons' => Lesson::count(),
            'teachers' => Teacher::count(),
            'courses' => Course::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
