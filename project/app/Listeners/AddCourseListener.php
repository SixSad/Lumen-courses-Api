<?php

namespace App\Listeners;

use App\Events\AddCourseEvent;
use App\Models\Course;
use App\Models\CourseUser;
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

    public function handle(AddCourseEvent $event)
    {
        $course = Course::where('id',$event->record->course_id)->first();
        $course_users = CourseUser::where('course_id',$event->record->course_id)->count();
        $course_user = CourseUser::where('course_id',$event->record->course_id)->where('user_id',$event->record->user_id)->first();

        if(!empty($course_user)){
            $event->record->delete();
            return 'You are already enrolled';
        }
        if($course->capacity()<=$course_users){
            $event->record->delete();
            return 'There are no places to enroll';
        }
        $event->record->save();
        return 'Congratulations, you have enrolled in the course';
    }
}

