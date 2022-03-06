<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_User extends Model
{
    protected $table = 'course_users';
    use HasFactory;
    public $timestamps = false;
    protected $guarded = array('id');

    public function singleUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function singleCourse()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function isEnroll($user_id){
        return $this->where('user_id',$user_id)->exists();
    }
}
