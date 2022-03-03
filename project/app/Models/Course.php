<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $table = 'courses';
    public $timestamps = false;
    use HasFactory;

    protected $guarded = [
        'id'
    ];


    public function courses()
    {
        return $this->hasMany('Course_User','course_id');
    }

    public function lessons()
    {
        return $this->hasMany('Lessons','course_id');
    }
}
