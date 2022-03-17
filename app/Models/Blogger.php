<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class Blogger  extends Authenticatable
{
    use  HasApiTokens,HasFactory;
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'user_id', 'id');
    }
}
