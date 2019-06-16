<?php

namespace App\Http\View\Composers;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\View\View;

class PageTitleComposer
{
    /**
     * The router instance used by the route.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * The Translator implementation.
     *
     * @var \Illuminate\Contracts\Translation\Translator
     */
    protected $translator;

    /**
     * PageTitleComposer constructor.
     *
     * @param Router $router
     * @param Translator $translator
     */
    public function __construct(Router $router, Translator $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $routeName = $this->router->currentRouteName();
        if ($routeName) {
            $titleTranslationKey = route_name_to_translation_key($routeName);
            if ($this->translator->has($titleTranslationKey)) {
                $view->with('pageTitle', $this->translator->trans($titleTranslationKey));
            }
        }
    }
}