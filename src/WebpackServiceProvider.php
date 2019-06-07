<?php

namespace Sandbox\Webpack;

use Sandbox\Webpack\Middleware\WebpackMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class WebpackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('Illuminate\Contracts\Http\Kernel')->pushMiddleware(WebpackMiddleware::class);

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('webpack.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/defaults.php', 'webpack');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Route::get('webpack-asset','Curator');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        // Frontend routes
    }
}
