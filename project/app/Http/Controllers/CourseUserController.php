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

        $course = Course::where('title',$request->title)->orWhere('id',$request->id)->first();

        if(empty($course)){
            return response()->json(['message'=>'Input correct data'],400);
        }

        $record = new Course_User();
        $record->course_id=$course->id;
        $record->user_id=Auth::user()->id;

        return response()->json(['message'=>event(new AddCourseEvent($record))[0]]);
    }
}
