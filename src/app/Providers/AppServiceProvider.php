<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Http\Kernel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->registerForLocal();
        }

        if (!$this->app->make('request')->expectsJson()) {
            // Start session for rendering error page using adminlte template if user is authenticated
            $kernel = $this->app->make(Kernel::class);
            $kernel->pushMiddleware(\Illuminate\Session\Middleware\StartSession::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services for local environment.
     *
     * @return void
     */
    protected function registerForLocal()
    {
        // IDE Helper Generator from "barryvdh/laravel-ide-helper" package
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        // Debug bar from "barryvdh/laravel-debugbar" package
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        AliasLoader::getInstance(['Debugbar' => \Barryvdh\Debugbar\Facade::class]);
        //  Debug assistant for the Laravel framework from "laravel/telescope" package
        $this->app->register(TelescopeServiceProvider::class);
    }
}
