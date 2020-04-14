<?php

namespace App\Traits;


use App\User;

trait Auther{

    //user creater
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

}