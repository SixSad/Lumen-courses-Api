<?php

namespace App\Http\Controllers;

use App\Models\LessonUser;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Throwable;


class LessonUserController extends BaseController
{
    public function update($id)
    {
        try {
            $user_lesson = LessonUser::lessonUser($id, Auth::user()->id);

            if (empty($user_lesson)) {
                throw new Exception('Incorrect lesson', 404);
            }

            if ($user_lesson->is_passed == true) {
                throw new Exception('You have already completed the lesson', 200);
            }

            $user_lesson->update(['is_passed' => true]);

        } catch (Throwable $e) {

            return response()->json([
                'data'=>[
                    'message' => $e->getMessage(),
                ]
            ],$e->getCode());
        }

        return response()->json([
            'data'=> [
                'message' => 'congratulations you have completed the lesson',
                'lesson_id' => $user_lesson->lesson_id
            ]
        ]);
    }
}
