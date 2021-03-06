<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
  public function __contruct()
  {
    $this->middleware('guest:admin', ['except' => ['logout']]);
  }
  public function showLoginForm()
  {
    return view('auth.admin_login');

  }
  public function login(Request $request)
  {
    //validate the form data
    $this->validate($request, [
      'email'  => 'required|email',
      'password'  =>'required|min:6'
    ]);
    //attempt to log the user in
    if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'  => $request->password], $request->remember)){
      //if successful,then redirect to their intended location
      return redirect()->intended(route('admin.dashboard'));
    }
    else{
     //if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email','remember'))->with('flash_message_error',"User not found <br> Email or Password Error");
    }
  }

  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect('admin/login');
  }
}
