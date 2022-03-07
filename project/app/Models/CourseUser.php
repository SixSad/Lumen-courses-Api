<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseUser extends Model
{
    protected $table = 'course_users';
    use HasFactory;

    public $timestamps = false;
    protected $guarded = array('id');

    public function singleUser(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function singleCourse(): BelongsTo
    {
        return $this->belongsTo('App\Models\Course');
    }

    public static function checkEnroll($course_id, $user_id)
    {
        return CourseUser::where('course_id', $course_id)->where('user_id', $user_id)->exists();
    }
}
