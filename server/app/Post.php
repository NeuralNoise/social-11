<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "text"];

    public function likes()
    {
    	return $this->belongsToMany('\App\User', 'like_post');
    }

    public function addLike($userId)
    {	
    	$wasLike = false;
    	if ($this->likes()->get()) {
    		foreach ($this->likes()->get() as $userWhoLiked) {
	    	 	if ($userWhoLiked->id == \Auth::user()->id) {
					$this->likes()->detach(\Auth::user()->id);
					$wasLike = true;
	    	 	}
	    	}	
    	} 
    		if ($wasLike !== true) {
    			$this->likes()->attach(\Auth::user()->id);
    		}
    	
	    
    }

    public function author()
    {
    	return $this->belongsToMany('App\User', 'post_user');
    }

    public function isRepost($post_id) 
    {
        $post = \App\Post::find($post_id);


        return $post->repost()->first() ? true : false;


    }

    public function repost()
    {
        return $this->belongsToMany('App\Repost');
    }

    public function repostsCount()
    {
        

        return count(\App\Repost::where('orig_post_id', '=', $this->id)->get());
    }

}
