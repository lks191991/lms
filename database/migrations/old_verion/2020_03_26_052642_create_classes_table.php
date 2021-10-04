<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title');
            $table->longText('content');
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('tutor_id')->unsigned();
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            
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
        Schema::dropIfExists('classes');
    }
}
