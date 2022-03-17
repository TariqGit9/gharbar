<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [];
    public function get_table()
    {
        return $this->belongsTo('App\Models\Blogger', 'user_id', 'id');
    }

}
