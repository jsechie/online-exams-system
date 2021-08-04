<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->index();
            $table->text('title');
            $table->integer('total_questions')->nullable();
            $table->integer('total_marks');
            $table->string('exams_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('stop_time')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('status')->default('0');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('exams_settings');
    }
}
