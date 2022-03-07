<?php

namespace App\Events;

use App\Models\CourseUser;

class AddCourseEvent extends Event
{
    public $record;
    public function __construct(CourseUser $record)
    {
        $this->record=$record;
    }
}
