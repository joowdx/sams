<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('log_by_id')->nullable();
            $table->string('log_by_type')->nullable();
            $table->unsignedBigInteger('from_by_id')->nullable();
            $table->string('from_by_type')->nullable();
            $table->enum('type', ['entry', 'exit'])->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->enum('remarks', ['ok', 'late', 'fail']);
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
        Schema::dropIfExists('logs');
    }
}
