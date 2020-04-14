<?php

namespace App\Providers;

use App\Contracts\ProductContract;
use App\Product;
use App\Repositories\ProductRepository;
use App\Test\Test;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $repositories = [
        ProductContract::class => ProductRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(E_ALL ^ E_NOTICE); // Ignores notices and reports all other kinds

    }
}
