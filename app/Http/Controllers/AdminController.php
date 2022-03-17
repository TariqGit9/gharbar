<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Blogger;

use App\Models\User;

use Auth;
use Hash; 

use DataTables;
//Traits 
use App\Http\Traits\AuthenticateAllUser;
use App\Http\Traits\AllUserTable;


class AdminController extends Controller
{
    use AuthenticateAllUser;
    use AllUserTable;

    public function login()
    {
        $user="Admin";
        $login_route="admin-authenticate";
        return view('auth.login', compact('user','login_route'));
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $model=  new Admin;
        $response = $this->authenticateUser($model,$request->email,$request->password,'admin');
        if( $response ){
            return redirect()->route('admin-index');
        }else{
            return back()->with('error', 'Email or password is incorrect');  
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index()
    {
        return view('layouts.all-users');
    }
    public function getUsers(Request $request)
    {
        $type= $request->user_type;
        $data = Blogger::all();
        return $this->getAllUsers($data,$type);
    }

}
