<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogger;
use App\Models\Blog;


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
        $response = $this->authenticateUser($model,$request->email,$request->password,'blogger');
        return $response;
    }

    public function logout()
    {
        Auth::guard('bloggers')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index(Request $request)
    {
        $user_type="blogger";
        return view('blogger.blogs', compact('user_type'));
    }
    public function addBlogs (Request $request)
    {
        $data = new Blog();
        $data->description = $request->description;
        $data->user_id = $request->id;
        $data->save();
        return $data;
    }
    public function myBlogs(Request $request)
    {
        $data = Blog::where('user_id', $request->id)->get();
        return $data;
    }
}
