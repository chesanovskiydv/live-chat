<?php

namespace App\Http\View\Composers;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminLteErrorComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $exception = $view->offsetGet('exception');

        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            if ($statusCode >= 400 && $statusCode < 500) {
                $view->with('textClass', 'text-yellow');
            } elseif ($statusCode >= 500 && $statusCode < 600) {
                $view->with('textClass', 'text-red');
            }
        }
    }
}