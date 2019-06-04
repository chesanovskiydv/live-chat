<?php

namespace App\Providers;

use App\Html\Macros\Actions;
use App\Html\Macros\SearchForm;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapThree();

        \Form::macro('searchForm', [app(SearchForm::class, [
            'searchName' => sprintf('%s[%s]', config('query-builder.parameters.filter'), SearchForm::DEFAULT_SEARCH_NAME)
        ]), '__invoke']);

        \Form::macro('actions', [app(Actions::class), '__invoke']);
    }
}
