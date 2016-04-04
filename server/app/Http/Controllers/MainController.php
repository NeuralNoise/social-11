<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Post;
class MainController extends Controller
{
    public function home()
    {
    	if (\Auth::user()) {
    		$user = User::find(\Auth::user()->id);
    	} else {
    		return redirect('login');
    	}
    	$post =\App\Post::find(64);
    	// dd($post->repost()->get());

    	$posts = $user->posts()->orderBy('created_at', 'desc')->get();

    	// dd($user->posts()->get());

    	return view('home', compact('user',  'posts'));
    }

    public function addLike($post_id)
    {
    	$post = Post::find($post_id);
    	$post->addLike(\Auth::user()->id);
    	return redirect()->back();
    }

    public function showUser($id)
    {
    	$user = User::find($id);
    	$posts = $user->posts()->get();
    	return view('home', compact('user',  'posts'));
    }

    public function addPost()
    {
    	$post = Post::create([
    		'title' => $_POST['title'],
    		'text' =>	$_POST['text']
    	]);
    	$post->author()->attach(\Auth::user()->id);
    	return redirect('/');
    }

    public function deletePost($post_id)
    {
    	$post = Post::find($post_id);
    	$post_author = $post->author()->get();

    	if ($post_author[0]->id == \Auth::user()->id) {
    		$post->delete();
    	}

    	return redirect('/');
    }
}
