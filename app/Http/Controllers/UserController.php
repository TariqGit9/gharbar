<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use Hash; 
use Session;
use App\Http\Traits\AuthenticateAllUser;
use App\Http\Traits\AllUserInfo;
class UserController extends Controller
{
    use AuthenticateAllUser;
    use AllUserInfo;
    public function login()
    {
        $user="User";
        $login_route="user-authenticate";
        return view('auth.login', compact('user','login_route'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $model=  new User;

        $response = $this->authenticateUser($model,$request->email,$request->password,'user');
        return $response;
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
