<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App; // Appクラスをインポートする
use Illuminate\Support\Facades\URL; // URLクラスをインポートする

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
        if (App::environment('production','staging','local')) {
            URL::forceScheme('https');
        }
    }
}
