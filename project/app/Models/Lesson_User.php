<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson_User extends Model
{
    protected $table = 'lesson_users';

    public function single_user()
    {
        return $this->belongsTo('User');
    }

    public function single_lesson()
    {
        return $this->belongsTo('Lesson');
    }
}
