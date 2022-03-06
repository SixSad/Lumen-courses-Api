<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class CourseLessonController extends BaseController
{
    public function index(Request $request)
    {
        $course_id = $request->course_id;

        if(empty($course_id)){
            return response()->json(['message'=>'Bad Request'],400);
        }

        if(empty(Course::find($course_id))){
            return response()->json(['message'=>'Course not found'],400);
        }

        $lessons = Lesson::where('course_id',$course_id)->get();

        return response()->json(['course_lessons'=>$lessons]);
    }
}
