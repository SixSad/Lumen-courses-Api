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

    public function single_user()
    {
        return $this->belongsTo('User');
    }

    public function single_course()
    {
        return $this->belongsTo('Course');
    }
}
