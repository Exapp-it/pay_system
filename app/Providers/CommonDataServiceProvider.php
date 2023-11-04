<?php

namespace App\Providers;

use App\Models\Merchant;
use Illuminate\Support\ServiceProvider;

class CommonDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->share('approvedMerchants', Merchant::where('approved', false)
            ->where('rejected', false)
            ->count());
    }
}
