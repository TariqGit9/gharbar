<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class SuperAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
