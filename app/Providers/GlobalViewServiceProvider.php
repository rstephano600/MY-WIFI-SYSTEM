<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Make $userRole available in all views
        View::composer('*', function ($view) {
            $userRole = Auth::check() ? Auth::user()->role : null;
            $view->with('userRole', $userRole);
        });
    }
}
