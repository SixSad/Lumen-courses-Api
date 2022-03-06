<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EnrollUserTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
                    CREATE FUNCTION enroll_user_function()
                            RETURNS trigger AS $$
                            BEGIN
                                INSERT INTO lesson_users (user_id,lesson_id,is_passed)
                                SELECT NEW.user_id,lessons.id,false FROM lessons
                                WHERE course_id = NEW.course_id;
                                RETURN NEW;
                            END;
                            $$ LANGUAGE plpgsql;


                    CREATE TRIGGER enroll_user_trigger
                    AFTER INSERT ON course_users
                    FOR EACH ROW
                    EXECUTE PROCEDURE enroll_user_function();");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DROP TRIGGER enroll_user_trigger ON course_users;
        DROP FUNCTION enroll_user_function() cascade;');
    }
}
