<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
class TestFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        App::bind('test',function() {
            return new \App\Test\Test;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
