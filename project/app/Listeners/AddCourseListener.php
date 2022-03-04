<?php

namespace App\Listeners;

use App\Events\AddCourseEvent;
use App\Events\ExampleEvent;
use App\Models\Course_User;
use http\Env\Response;
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
        if(Course_User::where('course_id',$event->record->course_id)->where('user_id',$event->record->user_id)->exists()){
            $event->record->delete();
            return false;
        }
        $event->record->save();
        return true;
    }
}

