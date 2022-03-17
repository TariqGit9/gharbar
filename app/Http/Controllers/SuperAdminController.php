<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use App\Models\User;

use Auth;
use Hash; 
use Session;
//Traits 
use App\Http\Traits\AuthenticateAllUser;
use App\Http\Traits\AllUserTable;


class SuperAdminController extends Controller
{
    use AuthenticateAllUser;
    use AllUserTable;
    public function login()
    {
        $user="SuperAdmin";
        $login_route="super-admin-authenticate";
        return view('auth.login', compact('user','login_route'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $model=  new SuperAdmin;
        // $model=  new User;

        $response = $this->authenticateUser($model,$request->email,$request->password,'superadmin');
        return $response;
    }

    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index()
    {
        $user="super-admin";
        dd(Session::get('session-key'));
        return view('layouts.all-users', compact('user'));
    }
    public function getUsers(Request $request)
    {
        $type= $request->user_type;
        if($type=='admin'){
            $model=  new Admin;
        }elseif($type=='user'){
            $model=  new User;
        }elseif($type=='blogger'){
            $model=  new Blogger;
        }
        $data = $model::all();
        return $this->getAllUsers($data,$type);
    }
    public function deleteUser(Request $request)
    {
        dd("Abcd");
    }
}
