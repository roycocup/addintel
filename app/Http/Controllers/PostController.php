<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {   
        $posts = Post::with('user')->get()->sortBy(function($post, $key){
            return $post->created_at->timestamp;
        });

        return view('post.index', compact('posts'));
    }

    public function show($post_id)
    {
        $post = Post::find($post_id)->with('user')->first();
        
        return view('post.show', compact('post'));
    }
}
