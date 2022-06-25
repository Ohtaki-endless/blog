<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post)
    {
        // $posts = $post->getByLimit();
        // dd($posts);
        return view('posts/index')->with(['posts' => $post->getByLimit()]);
    }
}
?>
