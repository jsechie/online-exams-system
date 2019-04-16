<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('exams_id');
            $table->string('exams_type');
            $table->string('course_name');
            $table->string('course_code');
            $table->integer('credit_hours');
            $table->string('academic_year');
            $table->integer('academic_semester');
            $table->double('marks_scored');
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
        Schema::dropIfExists('students_results');
    }
}
