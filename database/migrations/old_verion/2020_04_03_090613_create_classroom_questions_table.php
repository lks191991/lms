<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
			$table->string('sender_type');
			$table->bigInteger('sender_id')->unsigned();			
			$table->bigInteger('receiver_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            
            $table->foreign('sender_id')->references('id')->on('users');
			$table->foreign('receiver_id')->references('id')->on('users');
			
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
        Schema::dropIfExists('classroom_questions');
    }
}
