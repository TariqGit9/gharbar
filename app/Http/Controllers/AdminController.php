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
use App\Http\Traits\AllUserInfo;


class AdminController extends Controller
{
    use AuthenticateAllUser;
    use AllUserInfo;

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
        return $response;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home')->with('success', 'Logged out!');
    }
    public function index()
    {
        $user_type="admin";
        $user="admin";
        return view('all-users', compact('user_type','user'));
    }
    public function getUsers(Request $request)
    {
        $type= $request->user_type;
        $model=  new Blogger;
        $data = $model::all();
        return $this->getAllUsers($data,$type);
    }
    public function deleteUser(Request $request)
    {
        $type = $request->type;
        $model=  new Blogger;
        $model::find($request->id)->delete();
        return response()->json([
            'success' => true,
        ], 200);
        
    }
    public function editUser(Request $request)
    {
        $type = $request->type;
        $model=  new Blogger;
        return $this->editUserInfo($request,$model);
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name' => ['required']
        ]);
        $type = $request->type;
        // dd($request->all());
        if($type=='admin'){
            $model=  new Admin;
        }elseif($type=='user'){
            $model=  new User;
        }elseif($type=='blogger'){
            $model=  new Blogger;
        }
        return $this->addUserInfo($request,$model);
    }
}
