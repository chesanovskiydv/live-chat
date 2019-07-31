<?php

namespace App\Providers;

use App\Http\View\Composers\AdminLteErrorComposer;
use App\Http\View\Composers\PageTitleComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', PageTitleComposer::class);
        View::composer('layouts.adminlte-error', AdminLteErrorComposer::class);

        $this->loadViewsFrom(resource_path("views/admin"), 'admin');
    }
}
