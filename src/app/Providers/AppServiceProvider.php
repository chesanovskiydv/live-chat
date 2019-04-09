<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->registerForLocal();
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
        // Debug bar from "barryvdh/laravel-debugbar"
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        AliasLoader::getInstance(['Debugbar' => \Barryvdh\Debugbar\Facade::class]);
    }
}
