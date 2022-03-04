<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class CourseUserController extends BaseController
{
    public function create(Request $request)
    {
        $this->validate($request, [
            "title" => 'required|string',
        ]);
        $user = Auth::user()->id;
        $course = Course::where('title',$request->title)->first();
        $record = Course_User::create(['user_id'=>$user,'course_id'=>$course->id]);
        return response()->json($record);
    }
}
