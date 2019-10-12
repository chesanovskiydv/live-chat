<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Html\Macros\{
    Actions, Element, Pagination, Sortablelink, SearchForm, Form
};

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

        \Html::macro('sortableLink', [app(SortableLink::class, [
            'sortParameter' => config('query-builder.parameters.sort'),
            'defaultDirection' => SortableLink::ASCENDING,
            'multiple' => false
        ]), '__invoke']);

        \Html::macro('searchForm', [app(SearchForm::class, [
            'searchName' => sprintf('%s[%s]', config('query-builder.parameters.filter'), SearchForm::DEFAULT_SEARCH_NAME)
        ]), '__invoke']);

        \Html::macro('actions', [app(Actions::class), '__invoke']);
        \Html::macro('pagination', [app(Pagination::class), '__invoke']);
        \Html::macro('form', [app(Form::class), '__invoke']);
        \Html::macro('element', [app(Element::class), '__invoke']);
    }
}
