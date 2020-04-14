<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ExampleFacades extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'test';
    }
}
