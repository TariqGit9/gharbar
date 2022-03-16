<?php

namespace App\Http\Traits;
use Auth;
use Hash; 


trait AuthenticateAllUser {
    public function authenticateUser($model,$email,$password,$guard) {
        
        $result = $model::query()->where('email', $email)->first();

        if(!$result){
            return false;
        }

        if (!Hash::check($password, $result->password)) {
            return false;
        }
        Auth::guard($guard)->login($result);
        return true;
    }

}