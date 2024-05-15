<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    } 

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */

    public const HOME = '/redirect';



    /**
     * Bootstrap services.
     */
    public function boot()
    {
       
    }
}
