<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {   
        $posts = Post::all()->sortBy(function($post, $key){
            return $post->created_at->timestamp;
        });

        return view('post.index', compact('posts'));
    }
}
