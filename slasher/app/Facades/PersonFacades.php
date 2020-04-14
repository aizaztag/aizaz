<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PersonFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'person';
    }
}
