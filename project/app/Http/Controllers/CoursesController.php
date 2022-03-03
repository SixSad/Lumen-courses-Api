<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CoursesController extends BaseController
{
    public function index()
    {
        return Course::all()->sortBy('id');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:courses',
            'student_capacity' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $course = Course::create($request->all());
        return response()->json($course);
    }

//    public function ZXc()
//    {
//
//    }
}
