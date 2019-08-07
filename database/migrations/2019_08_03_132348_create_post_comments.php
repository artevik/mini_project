<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_post');
            $table->unsignedInteger('id_comment');
            $table->unsignedInteger('id_parent_comment');
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts')
                  ->onDelete('cascade');
            $table->foreign('id_comment')->references('id')->on('comments')
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
        Schema::dropIfExists('post_comments');
    }
}
