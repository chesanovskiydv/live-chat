<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;

abstract class BaseMacros
{
    /**
     * The HTML builder instance.
     *
     * @var \Collective\Html\HtmlBuilder
     */
    protected $html;

    /**
     * The Form builder instance.
     *
     * @var \Collective\Html\FormBuilder
     */
    protected $form;

    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new macros instance.
     *
     * @param HtmlBuilder $html
     * @param FormBuilder $form
     * @param UrlGenerator $url
     * @param Request $request
     */
    public function __construct(HtmlBuilder $html, FormBuilder $form, UrlGenerator $url, Request $request)
    {
        $this->html = $html;
        $this->form = $form;
        $this->url = $url;
        $this->request = $request;
    }

    /**
     * Transform the string to an Html serializable object
     *
     * @param string $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString(string $html): HtmlString
    {
        return new HtmlString($html);
    }

    /**
     * Wraps the content with a tag.
     *
     * @param string $tag
     * @param string $content
     * @param array $attributes
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function wrapWithTag(string $tag, string $content, array $attributes = []): HtmlString
    {
        $tag = str_replace(['</', '/>', '<', '>'], '', strtolower($tag));
        $attributes = $this->html->attributes($attributes);

        return $this->toHtmlString('<' . $tag . $attributes . '>' . $content . '</' . $tag . '>');
    }

    /**
     * Get the url for a "url" option.
     *
     * @param  array|string $options
     *
     * @return string
     */
    protected function getUrl($options): string
    {
        if (is_array($options)) {
            return $this->url->to($options[0], array_slice($options, 1));
        }

        return $this->url->to($options);
    }

    /**
     * Get the url for a "route" option.
     *
     * @param  array|string $options
     *
     * @return string
     */
    protected function getRouteUrl($options): string
    {
        if (is_array($options)) {
            return $this->url->route($options[0], array_slice($options, 1));
        }

        return $this->url->route($options);
    }

    /**
     * Get the url for an "action" option.
     *
     * @param  array|string $options
     *
     * @return string
     */
    protected function getControllerUrl($options): string
    {
        if (is_array($options)) {
            return $this->url->action($options[0], array_slice($options, 1));
        }

        return $this->url->action($options);
    }
}
