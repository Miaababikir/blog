<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tag;

class TagController extends Controller
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
        // Getting all the tags that in the database
        $tags = Tag::all();

        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data in the forms
        $this->validate($request, [
          'name' => 'required|max:255'
        ]);

        $tag = new Tag;
        $tag->name = $request->name;

        $tag->save();

        Session::flash('success', 'Tag is successfully created');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Getting the tag by the id
        $tag = Tag::find($id);

        return view('tags.edit', $tag)->withTag($tag);

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
        // Find the tag by the id
        $tag = Tag::find($id);

        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $tag->name = $request->name;

        $tag->save();

        Session::flash('success', 'Tag is successfully updated');

        return redirect()->route('tags.show', $tag->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Find the tag that we wont to delete
      $tag = Tag::find($id);
      $tag->posts()->detach();

      // Delete the tag
      $tag->delete();

      // Success message
      Session::flash('success', 'The blog tag is successfully Deleted');

      // Redirect to other page with the success message
      return redirect()->route('tags.index');
    }
}
