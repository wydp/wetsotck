<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Delivery;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\Tank;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tell Laravel to use custom PKs for route model binding
        \Illuminate\Database\Eloquent\Model::preventLazyLoading(
            ! app()->isProduction()
        );
    }
}
