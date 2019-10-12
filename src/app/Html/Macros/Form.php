<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Kris\LaravelFormBuilder\Form as KrisForm;

class Form extends BaseMacros
{
    /**
     * The View Factory instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new macros instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     * @param \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Factory $view, HtmlBuilder $html, FormBuilder $form, UrlGenerator $url, Request $request)
    {
        $this->view = $view;

        parent::__construct($html, $form, $url, $request);
    }

    /**
     * @param \Kris\LaravelFormBuilder\Form $form
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(KrisForm $form): HtmlString
    {
        return $this->toHtmlString(
            $this->view->make("macros.form", [
                'form' => $form,
                'model' => optional($form->getModel()),
            ])->render()
        );
    }
}
