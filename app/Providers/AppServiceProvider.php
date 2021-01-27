<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('administrator', function () { 
            if (!Auth::user()) return FALSE;           
            return Auth::user()->hasRole('administrator');
        });

        \Blade::if('nastavnik', function () {  
            if (!Auth::user()) return FALSE;           
            return Auth::user()->hasRole('nastavnik');
        });

        \Blade::if('ucenik', function () { 
            if (!Auth::user()) return FALSE;           
            return Auth::user()->hasRole('učenik');
        });
    }
}
