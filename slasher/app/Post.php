<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
