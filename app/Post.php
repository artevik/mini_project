<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'image',
        'slug',
        'published_at',
    ];

    public function user() {
        return $this->belongsToMany(
            'App\User',
            'user_posts',
            'id_post',
            'id_user'
        );
    }

    public function comments() {
        return $this->belongsToMany(
            'App\Comment',
            'post_comments',
            'id_post',
            'id_comment'
        )->withPivot('id_parent_comment');
    }
}
