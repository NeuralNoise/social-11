<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RepostController extends Controller
{
    public function makeRepost($post_id)
    {
    	 // dd($post_id);
            // creating post on the wall
            $post = \App\Post::create([
            	'title' => $_POST['comment_title'],
            	'text' => $_POST['comment_text']
            ]);
            $post->author()->attach(\Auth::user()->id);
            // creatin repost
            // dd($post_id);
            $repost = \App\Repost::create([
            	'reposter_id' => \Auth::user()->id,
            	'orig_poster_id' => \App\Post::find($post_id)->author[0]->id,
            	'orig_post_id' => $post_id,
            	'orig_post_title' => \App\Post::find($post_id)->title,
            	'orig_post_text' => \App\Post::find($post_id)->text,
            	'orig_post_data' => \App\Post::find($post_id)->created_at
            ]);
            // pivot repost v poste
            // $repost->posts()->attach(\App\Post::find($post_id)->id);
            $post->repost()->attach($repost->id);

            return redirect('/');
    }

}
            
            