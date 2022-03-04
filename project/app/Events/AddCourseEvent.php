<?php

namespace App\Events;

use App\Models\Course_User;

class AddCourseEvent extends Event
{
    public $record;
    public function __construct(Course_User $record)
    {
        $this->record=$record;
    }
}
