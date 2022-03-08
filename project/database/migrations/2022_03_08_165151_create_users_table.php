<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(false)->unique();
            $table->string('password')->nullable(false);
            $table->string('phone',16)->nullable(false);
            $table->string('last_name',64)->nullable(true);
            $table->string('first_name',64)->nullable(true);
            $table->boolean('is_admin')->default(0)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
