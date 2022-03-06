<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Course_User;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class Course_UserFactory extends Factory
{

    protected $model = Course_User::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'course_id' => Course::all()->random()->id,
            'percentage_passing' => 0,
        ];
    }
}
