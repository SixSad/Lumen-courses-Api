<?php

namespace App\Http\Controllers;

use App\Events\AddCourseEvent;
use App\Models\Course;
use App\Models\CourseUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class CourseUserController extends BaseController
{
    public function add(Request $request)
    {
        $this->validate($request, [
            "id" => 'required|integer',
        ]);

        try {
            $course = Course::find($request->id);

            if (empty($course)) {
                throw new Exception('Input correct data', 400);
            }

            $record = new CourseUser();
            $record->course_id = $course->id;
            $record->user_id = Auth::user()->id;
            event(new AddCourseEvent($record));

        } catch (Exception $e) {

            return response()->json([
                'data' => [
                    'message' => $e->getMessage()
                ]
            ], $e->getCode());
        }

        return response()->json([
            'data' => [
                'message' => 'Congratulations, you have enrolled in the course',
                'course_id' => $record->course_id
            ]
        ], 201);
    }
}
