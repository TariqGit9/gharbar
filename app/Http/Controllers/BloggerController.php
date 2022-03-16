<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogger;

use Auth;
use Hash; 

//Traits 
use App\Http\Traits\AuthenticateAllUser;

class BloggerController extends Controller
{
    use AuthenticateAllUser;

    public function login()
    {
        $user="Blogger";
        $login_route="blogger-authenticate";
        return view('auth.login', compact('user','login_route'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $model=  new Blogger;
        $response = $this->authenticateUser($model,$request->email,$request->password,'bloggers');
        
        if( $response ){
            return redirect()->route('blogger-index');
        }else{
            return back()->with('error', 'Email or password is incorrect');  
        }
    }

    public function logout()
    {
        Auth::guard('bloggers')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index()
    {
        dd("Success blogger");
    }
}
