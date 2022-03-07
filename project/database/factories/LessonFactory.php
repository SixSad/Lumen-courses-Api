<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{

    protected $model = Lesson::class;

    public function definition()
    {
        return [
            'course_id' => Course::all()->random()->id,
            'theme' => $this->faker->word,
        ];
    }
}
