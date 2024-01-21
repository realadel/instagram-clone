<?php

namespace App\Http\Controllers;

use App\Models\Post;

class likeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        auth()->user()->likes()->toggle($post->id);
        return back();
    }
}
