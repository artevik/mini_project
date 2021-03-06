<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('comment_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_comments');
    }
}
