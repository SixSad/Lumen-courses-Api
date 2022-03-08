<?php

namespace App\Listeners;

use App\Events\AddCourseEvent;
use App\Models\Course;
use App\Models\CourseUser;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCourseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws Exception
     */
    public function handle(AddCourseEvent $event)
    {
        $course = Course::where('id', $event->record->course_id)->first();
        $course_users = CourseUser::where('course_id', $event->record->course_id)->count();

        if (CourseUser::checkEnroll($event->record->course_id, $event->record->user_id)) {
            $event->record->delete();
            throw new Exception('You are already enrolled', 200);
        }

        if ($course->capacity() <= $course_users) {
            $event->record->delete();
            throw  new Exception('There are no places to enroll', 200);
        }

        return $event->record->save();
    }
}

