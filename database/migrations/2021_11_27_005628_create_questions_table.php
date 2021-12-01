<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedSmallInteger('id', true);
            $table->string('question', 255);
            $table->unsignedTinyInteger('question_category_id', false);
            $table->unsignedTinyInteger('employee_category_id', false);
            $table->timestamps();

            $table->foreign('question_category_id')->references('id')->on('question_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_category_id')->references('id')->on('employee_categories')->onUpdate('cascade')->onDelete('cascade');
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
