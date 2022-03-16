<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;

use Auth;
use Hash; 

//Traits 
use App\Http\Traits\AuthenticateAllUser;


class SuperAdminController extends Controller
{
    use AuthenticateAllUser;

    public function login()
    {
        $user="SuperAdmin";
        $login_route="super-admin-authenticate";
        return view('auth.login', compact('user','login_route'));
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $model=  new SuperAdmin;
        $response = $this->authenticateUser($model,$request->email,$request->password,'superadmin');
        
        if( $response ){
            return redirect()->route('super-admin-index');
        }else{
            return back()->with('error', 'Email or password is incorrect');  
        }
    }

    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index()
    {
        dd("Success Super admin");
    }
}
