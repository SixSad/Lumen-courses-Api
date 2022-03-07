<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonUser extends Model
{
    protected $table = 'lesson_users';
    public $timestamps = false;

    protected $guarded = [
        'is_admin', 'id'
    ];

    public function singleUser(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function singleLesson(): BelongsTo
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }

    public static function lessonUser($lesson_id, $user_id)
    {
        return LessonUser::where('lesson_id', $lesson_id)->where('user_id', $user_id)->first();
    }
}
