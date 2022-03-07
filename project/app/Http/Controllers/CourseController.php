<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CourseController extends BaseController
{
    public function index()
    {
        $course = Course::with('lessons')->get()->sortBy('id');
        return response()->json($course);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:courses|regex:/(^([a-z,0-9]+)?$)/ui',
            'student_capacity' => 'required|integer|between:5,99',
            'start_date' => 'required|date_format:Y-m-d|after_or_equal:date',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'has_certificate' => 'boolean',
        ]);

        $course = Course::create($request->all());
        return response()->json($course);
    }
}
