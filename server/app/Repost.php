<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
	protected $fillable = ["reposter_id", "orig_poster_id", "orig_post_id", "orig_post_title", "orig_post_text", "orig_post_data"];

    public function make()
    {


            
    }

    public function posts()
    {
    	return $this->belongsToMany('App\Post');
    }
}
