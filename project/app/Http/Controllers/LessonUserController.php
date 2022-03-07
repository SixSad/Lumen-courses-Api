<?php

namespace App\Http\Controllers;

use App\Models\LessonUser;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class LessonUserController extends BaseController
{
    public function update($id)
    {

        if (empty((int)$id)) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        $user_lesson = LessonUser::lessonUser($id, Auth::user()->id);

        if (empty($user_lesson)) {
            return response()->json(['message' => 'Input correct lesson'], 404);
        }

        if ($user_lesson->is_passed == true) {
            return response()->json(['message' => 'You have already completed the lesson']);
        }
        $user_lesson->update(['is_passed' => true]);

        return response()->json(['message' => 'congratulations you have completed the lesson', 'lesson' => $user_lesson]);
    }

}
