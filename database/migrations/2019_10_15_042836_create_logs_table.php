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
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->date('date');
            $table->enum('remarks', ['ok', 'late', 'excuse', 'absent', 'leave', 'entry', 'exit']);
            $table->enum('process', ['default', 'auto', 'overwritten', 'manual'])->default('default');
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
