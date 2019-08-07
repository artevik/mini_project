<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_post');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('id_post')->references('id')->on('posts')
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
        Schema::dropIfExists('user_posts');
    }
}
