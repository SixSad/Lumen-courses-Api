<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class ExampleCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'title' => 'example',
            'student_capacity' => 20,
            'start_date' => '2022-03-20',
            'end_date' => '2022-03-30',
            'has_certificate' => true,
        ]);
    }
}
