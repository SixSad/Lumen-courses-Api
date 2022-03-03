<?php

namespace Database\Seeders;

use App\Models\Course_User;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course_User::factory()->count(20)->create();
    }
}
