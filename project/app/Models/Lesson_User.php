<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson_User extends Model
{
    protected $table = 'lesson_users';
    public $timestamps = false;

    protected $guarded = [
        'is_admin','id'
    ];

    public function singleUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function singleLesson()
    {
        return $this->belongsTo('App\Models\Lesson','lesson_id');
    }
}
