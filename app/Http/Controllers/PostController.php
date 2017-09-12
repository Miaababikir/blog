<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use Session;

class PostController extends Controller
{


  public function __construct()
  {
    $this->middleware('auth:admin');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the posts from the database
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        // Send the posts to the view to show it
        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Getting all the tags in the database
        $tags = Tag::all();
        // Getting all the categories in the database
        $categories = Category::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate hte data
        $this->validate($request, array(
                'title' => 'required|max:255' ,
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'body' => 'required',
            ));

        // Store it in the database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post is created successfully');

        // Redirect to another page
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // Get the post data from the database and store it in var
        $post = Post::find($id);

        // Getting all the categories in the database
        $categories = Category::all();
        $cats = array();

        foreach ($categories as $category)
        {
          $cats[$category->id] = $category->name;
        }

        // Getting all the tags from the database
        $tags = Tag::all();
        $tags2 = [];

        foreach ($tags as $tag)
        {
            $tags2[$tag->id] = $tag->name;
        }

        // Pass the post data to the view
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $post = Post::find($id);

        if ($request->input('slug') == $post->slug)
        {
            $this->validate($request, array(
                        'title' => 'required|max:255' ,
                        'body' => 'required',
                        'slug' => 'required|alpha_dash|min:5|max:255'
                    ));
        }
        else
        {
            $this->validate($request, array(
                        'title' => 'required|max:255' ,
                        'body' => 'required',
                        'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug'
                    ));
        }

        // Save changes to database
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');

        $post->save();

        if (isset($request->tags))
        {
            $post->tags()->sync($request->tags, false);
        }else
        {
          $post->tags()->sync([]);
        }

        // Success flash message
        Session::flash('success', 'The blog post is updated successfully');

        // Redirect to view
        return redirect()->route('posts.update', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the post that we wont to delete
        $post = Post::find($id);
        $post->tags()->detach();

        // Delete the post
        $post->delete();

        // Success message
        Session::flash('success', 'The blog post is successfully Deleted');

        // Redirect to other page with the success message
        return redirect()->route('posts.index');

    }
}
