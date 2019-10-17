<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 4);
            $table->string('title', 10);
            $table->string('description');
            $table->string('sem', 3);
            $table->string('term', 3);
            $table->string('day_from', 1);
            $table->string('day_to', 1);
            $table->string('time_from', 5);
            $table->string('time_to', 5);
            $table->string('unit', 1);
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('faculty_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
