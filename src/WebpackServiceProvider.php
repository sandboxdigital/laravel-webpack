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

        $router = $this->app['router'];

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->mergeConfigFrom(__DIR__.'/config/defaults.php', 'webpack');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('webpack.php'),
        ]);

        // Doesn't work - add's to high in the Middleware chain
        //app('Illuminate\Contracts\Http\Kernel')->pushMiddleware(WebpackMiddleware::class);
        $groups = config('webpack.middlewareGroups');
        foreach ($groups as $group) {
            $router->pushMiddlewareToGroup($group, WebpackMiddleware::class);
        }
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
