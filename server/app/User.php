<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function postLikes()
    {
        // k kakim postam u etogo usera laiki
        return $this->belongsToMany('App\Post', 'like_post');
    }

    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
