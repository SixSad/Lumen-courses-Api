<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $table = 'lessons';
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany('App\Models\LessonUser', 'lesson_id');
    }

    public function courses(): BelongsTo
    {
        return $this->belongsTo('App\Models\Courses');
    }
}
