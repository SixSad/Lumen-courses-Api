<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Lesson;
use App\Models\Lesson_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class LessonUserController extends BaseController
{
    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id)->course_id;
        $course = Course::where('id',$lesson)->first();
        if($course->user!=Auth::user())
        {
            return response()->json('');
        }
        $lesson->update(['is_passed'=>true]);
        return $lesson;
    }

}
