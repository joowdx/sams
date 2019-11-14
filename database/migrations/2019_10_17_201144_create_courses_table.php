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
            $table->enum('semester', ['1ST', '2ND', 'SUMMER']);
            $table->enum('term', ['1ST', '2ND', 'SEMESTER'])->nullable();
            $table->enum('day_from', ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
            $table->enum('day_to', ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
            $table->string('time_from', 5);
            $table->string('time_to', 5);
            $table->string('unit', 1);
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
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
