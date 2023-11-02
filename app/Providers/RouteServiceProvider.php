<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')->group(function () {
                require base_path('routes/main.php');
                require base_path('routes/user.php');
                require base_path('routes/auth.php');
            });

            Route::middleware('web')
                ->prefix('merchant')
                ->group(base_path('routes/merchant.php'));
        });
    }
}
