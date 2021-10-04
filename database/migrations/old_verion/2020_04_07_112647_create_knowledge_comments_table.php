<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->bigInteger('knowledgebase_id')->unsigned();
            $table->bigInteger('sender_id')->unsigned();
            $table->enum('status', ['approved', 'unapproved', 'flagged'])->default('approved');
			
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
        Schema::dropIfExists('knowledge_comments');
    }
}
