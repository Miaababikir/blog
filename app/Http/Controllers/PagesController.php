<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use App\Post;


class PagesController extends Controller
{
    //To proccess all requsts for pages

    public function getIndex()
    {
        // Get all the posts from the database
        $posts = Post::paginate(5);

        // Passing the posts to the view to strat showing them
        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout()
    {
        $first = 'Mosab';
        $last = 'Ibrahim';
        $full = $first . ' ' . $last;
        $email = 'miaababikir@gmail.com';
        $data = array('fullname' => $full, 'email' =>$email);
        return view('pages.about')->withData($data);
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
      $this->validate($request, [
        'email' => 'required|email',
        'subject' => 'min:3',
        'body' => 'required|min:10'
      ]);

      $data = [
        'email' => $request->email,
        'subject' => $request->subject,
        'body' => $request->body
      ];

      Mail::send('emails.contact', $data, function ($message) use ($data)
      {
        $message->from($data['email']);
        $message->to('hello@gmail.com');
        $message->subject($data['subject']);
      });

      Session::flash('success', 'Your Email Was Sent!');
      return redirect()->route('blog.index');

    }



}
