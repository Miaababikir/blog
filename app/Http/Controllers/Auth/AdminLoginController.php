<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest:admin', ['except' => ['logout']]);
  }

  //
  public function showLoginForm()
  {
      return view('auth.admin-login');
  }

  public function login(Request $request)
  {
    // Validate the form data
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);

    // Attempt to log user in
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
    {
      // If success  redirect to page that user wont
      return redirect()->intended(route('posts.index'));
    }
    else
    {
      // If fail redirect to login view
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

  }

  /**
     * Log the admin out of the application.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }



}
