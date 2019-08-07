<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    protected $table = 'user_posts';

    protected $fillable = [
        'id_user', 'id_post'
    ];
}
