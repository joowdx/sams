<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnverifiedTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unverified_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['student', 'faculty', 'others'])->default('others');
            $table->bigInteger('uid');
            $table->enum('status', ['pending', 'ignored']);
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
        Schema::dropIfExists('unverified_tags');
    }
}
