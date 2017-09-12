<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class BlogController extends Controller
{
    public function getIndex()
    {
        // Getting the posts from the database
        $posts = Post::paginate(10);

        // Return the view with the posts that we get it from the database
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug)
    {

        // Getting the post that have the same slug
        $post = Post::where('slug', '=', $slug)->first();

        // Return the view and pass the post data with it

        return view('blog.single')->withPost($post);
    }

}
