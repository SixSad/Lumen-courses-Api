<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function lessons()
    {
        return $this->hasMany('Lesson_User','lesson_id');
    }

    public function courses()
    {
        return $this->belongsTo('Courses');
    }
}
