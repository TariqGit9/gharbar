<?php

namespace App\Http\Traits;
use Auth;
use Hash; 


trait AuthenticateAllUser {
    public function authenticateUser($model,$email,$password,$guard) {
        
        $result = $model::query()->where('email', $email)->first();
        if($result){

            if (!Hash::check($password, $result->password)) {
                return false;
            }
            // $data= Auth::guard('superadmin')->login($result);
            $success =  $result;
            // $success['token'] =  $result->createToken('superadmin',['superadmin'])->accessToken;
            $success['token'] =  $result->createToken($guard ,[$guard])->accessToken;
            
            
            return response()->json([
                'user' =>  $result,
                'guard' =>  $guard,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 200);
    }

}