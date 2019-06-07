# laravel-webpack


Update `/app/Providers/AppServiceProvider.php` register the `WebpackServiceProvider`

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