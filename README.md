# Laravel <> Webpack Integration #

- Version: 0.0.2

## Overview

...

## Installation

1) Use Composer to install in your Laravel project:
   
   `composer require sandboxdigital/laravel-webpack`
   
2) Add Service Provider
    
    1. Either add  `Sandbox\Webpack\WebpackServiceProvider::class,` to the `providers` array in `config/app.php`
  
    2. Or update `/app/Providers/AppServiceProvider.php` to register the `WebpackServiceProvider::class` depending on environment:

```php
class AppServiceProvider extends ServiceProvider
{
    // ...

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //...

        if ($this->app->environment() === 'local') {
            $this->app->register(\Sandbox\Webpack\WebpackServiceProvider::class);
        }
    }
}

```

3) Publish config using the `vendor:publish` Artisan command:
   
`php artisan vendor:publish --provider="Sandbox\Webpack\WebpackServiceProvider"`
