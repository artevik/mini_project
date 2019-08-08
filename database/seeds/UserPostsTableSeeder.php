<?php

use Illuminate\Database\Seeder;

class UserPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\UserPost::class, 75)->create();
    }
}
