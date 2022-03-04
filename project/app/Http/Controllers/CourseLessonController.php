<?php

namespace App\Http\Controllers;


use App\Models\Lesson;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class CourseLessonController extends BaseController
{
    public function index(Request $request)
    {
        $course = $request->course_id;
        $lessons = Lesson::where('course_id',$course)->get();
        return response()->json($lessons);
    }
}
