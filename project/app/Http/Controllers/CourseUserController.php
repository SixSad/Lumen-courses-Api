<?php

namespace App\Http\Controllers;

use App\Events\AddCourseEvent;
use App\Models\Course;
use App\Models\Course_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class CourseUserController extends BaseController
{
    public function add(Request $request)
    {
        $this->validate($request, [
            "title" => 'required|string',
        ]);
        $user = User::where('id',Auth::user()->id)->first();
        $course = Course::where('title',$request->title)->first();
        $record = new Course_User();
        $record->course_id=$course->id;
        $record->user_id=$user->id;
        if(event(new AddCourseEvent($record))){
            return response()->json(['message'=>'You have successfully enrolled in the course']);
        }
        return response()->json(['message'=>'You are already enrolled']);
    }
}
