<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->belongsToMany(
            'App\Post',
            'user_posts',
            'id_user',
            'id_post'
        );
    }

    public function comments() {
        return $this->belongsToMany(
            'App\Comment',
            'user_comments',
            'user_id',
            'comment_id'
        );
    }

    public function getImageAttribute(){
        return $this->profile_image;
    }

    public function getUserId(){
        return $this->id;
    }
}
