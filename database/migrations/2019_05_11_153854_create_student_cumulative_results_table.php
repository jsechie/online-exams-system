<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCumulativeResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_cumulative_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('course_name');
            $table->string('course_code');
            $table->integer('credit_hours');
            $table->double('mid_sem_mark');
            $table->double('end_of_sem_mark');
            $table->string('academic_year');
            $table->integer('academic_semester');
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
        Schema::dropIfExists('student_cumulative_results');
    }
}
