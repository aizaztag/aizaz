<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginToken extends Model
{


    protected $fillable  = ['user_id' , 'token'];

    /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function generateFor(User $user)
    {
        return static::create([
            'user_id' => $user->id,
            'token' => rand(0 , 50),
        ]);
    }

    public function send()
    {
        $url = url('/auth/token', $this->token);
        Mail::raw(
            "<a href='{$url}'>{$url}</a>",
            function ($message) {
                $message->to($this->user->email)
                    ->subject('Login to Laracasts');
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
