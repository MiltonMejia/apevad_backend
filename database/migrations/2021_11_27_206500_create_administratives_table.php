<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administratives', function (Blueprint $table) {
            $table->unsignedSmallInteger('id', true);
            $table->string('firstName', 100);
            $table->string('lastName', 100);
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('administrative_category_id', false);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('administrative_category_id')->references('id')->on('administrative_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administratives');
    }
}
