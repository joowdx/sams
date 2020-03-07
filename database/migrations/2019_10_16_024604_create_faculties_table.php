<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schoolid')->nullable()->unique();
            $table->unsignedBigInteger('uid')->nullable()->unique();
            $table->string('name', 60);
            $table->string('description')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('modified_by')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
