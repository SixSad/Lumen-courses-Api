<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CalculatingCoursePassingTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
                    CREATE FUNCTION calculating_course_passing_function()
                            RETURNS trigger AS $$
                            BEGIN
                                UPDATE course_users SET percentage_passing =
                                (SELECT count(*)*100/NULLIF((SELECT COUNT(*) FROM lesson_users),0) FROM lesson_users
                                WHERE is_passed = true AND user_id=NEW.user_id)
                                WHERE user_id=NEW.user_id;
                                RETURN NEW;
                            END;
                            $$ LANGUAGE plpgsql;


                    CREATE TRIGGER calculating_course_passing_trigger
                    AFTER UPDATE ON lesson_users
                    FOR EACH ROW
                    WHEN (NEW.is_passed = true)
                    EXECUTE PROCEDURE calculating_course_passing_function();");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DROP TRIGGER calculating_course_passing_trigger on lesson_users;
        DROP FUNCTION calculating_course_passing_function() cascade;');
    }
}
