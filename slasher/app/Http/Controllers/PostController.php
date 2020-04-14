<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function gate()
    {
        $post = \App\Post::find(1);

         //   dd($post);

        if (Gate::allows('update-post', $post)) {
            echo 'Allowed';
        } else {
            echo 'Not Allowed';
        }

        exit;
    }
}
