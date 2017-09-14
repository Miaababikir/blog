<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Session;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function __construct()
    {
      $this->middleware('auth:admin', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        // Validate the forms
        $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255',
          'comment' => 'required|min:5|max:2000'
        ]);

        $post = Post::find($post_id);

        // Store the comment into the Database
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', 'Comment was Added Successfully');

        return redirect()->route('blog.single', [$post->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Getting the comment that we wint to edit
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Getting the comment from the Database by the id
        $comment = Comment::find($id);

        $this->validate($request, ['comment' => 'required|max:2000']);

        $comment->comment = $request->comment;

        $comment->save();

        Session::flash('success', 'Comment is updated Successfully');

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->delete();

        Session::flash('success', 'Comment is Deleted');

        return redirect()->route('posts.show', $post_id);

    }
}
