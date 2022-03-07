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
                            DECLARE
                                course_key integer;
                            BEGIN
                                course_key = (SELECT course_id from lessons WHERE id=NEW.lesson_id);
                                UPDATE course_users SET percentage_passing =
                                (
                                SELECT count(*)*100/
                                (SELECT count(*) FROM LESSON_USERS as l inner join lessons as len on l.lesson_id = len.id WHERE course_id=course_key)
                                FROM LESSON_USERS as l inner join lessons as len on l.lesson_id = len.id
                                WHERE is_passed=true and user_id=NEW.user_id and course_id=course_key
                                    )
                                WHERE user_id=NEW.user_id and course_id = course_key;
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
