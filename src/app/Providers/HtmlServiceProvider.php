<?php

namespace App\Providers;

use App\Html\Macros\Actions;
use App\Html\Macros\Sortablelink;
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

        \Html::macro('searchForm', [app(SearchForm::class, [
            'searchName' => sprintf('%s[%s]', config('query-builder.parameters.filter'), SearchForm::DEFAULT_SEARCH_NAME)
        ]), '__invoke']);

        \Html::macro('actions', [app(Actions::class), '__invoke']);

        \Html::macro('sortableLink', [app(SortableLink::class, [
            'sortParameter' => config('query-builder.parameters.sort'),
            'defaultDirection' => SortableLink::ASCENDING,
            'multiple' => false
        ]), '__invoke']);
    }
}
