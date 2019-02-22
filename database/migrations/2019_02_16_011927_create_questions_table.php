<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->index();
            $table->text('question');
            $table->text('option_A');
            $table->text('option_B');
            $table->text('option_C')->nullable();
            $table->text('option_D')->nullable();
            $table->text('option_E')->nullable();
            $table->char('answer',5);
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
        Schema::dropIfExists('questions');
    }
}
