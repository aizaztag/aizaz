<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
       //$post = \DB::table('posts')->where('slug' , $slug)->first();
       //dd($post);
        //if (!$post) abort(404);

       //return view('post' , ['posts' => (Post::where('slug' , $slug)->first())??abort(404)]);
    }
}
