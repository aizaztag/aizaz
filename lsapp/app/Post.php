<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = true ;
    protected $fillable = ['title', 'body'];


    public  function user(){
        return  $this->belongsTo('App\User');
    }
}
