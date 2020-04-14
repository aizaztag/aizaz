<?php

namespace App\Providers;

use App\Aizaz\Aizaz;
use Illuminate\Support\ServiceProvider;

class AizazServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AA' , function (){
           return new Aizaz();
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
