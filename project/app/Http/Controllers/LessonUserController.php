<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Course_User;
use App\Models\Lesson;
use App\Models\Lesson_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class LessonUserController extends BaseController
{
    public function update($id)
    {
        $lesson = Lesson_User::where('lesson_id',$id)->where('user_id',Auth::user()->id)->first();
        $course = $lesson->singleLesson->course_id;

        if(!Course_User::where('course_id',$course)->where('user_id',Auth::user()->id)->exists())
        {
            return response()->json(['message'=>'You are not enrolled in the course']);
        }

        $lesson->update(['is_passed'=>true]);
        return response()->json(['message'=>'congratulations you have completed the lesson','lesson'=>$lesson->singleLesson]);
    }

}
