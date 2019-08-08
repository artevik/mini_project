<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'name',
        'email',
        'comment',
        'published_at',
    ];

    public function user() {
        return $this->belongsToMany(
            'App\User',
            'user_comments'
        );
    }

    public function posts() {
        return $this->belongsToMany(
            'App\Post',
            'post_comments',
            'id_post',
            'id_comment'
        )->withPivot('id_parent_comment');
    }

    public function replies() {
        return $this->belongsToMany(
            'App\Comment',
            'post_comments',
            'id_post',
            'id_comment'
        )->withPivot('id_parent_comment');
    }

    public function reply(){
        return $this->hasMany(Comment::class, 'id', 'id');
    }
}
