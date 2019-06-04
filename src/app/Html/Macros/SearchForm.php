<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;

class SearchForm extends BaseMacros
{
    /**
     * The default name of the search field.
     *
     * @var string
     */
    const DEFAULT_SEARCH_NAME = 'search';

    /**
     * The reserved form open attributes.
     *
     * @var array
     */
    protected $reserved = ['method', 'submitButton', 'searchField', 'container', 'except'];

    /**
     * The form methods that should be spoofed, in uppercase.
     *
     * @var array
     */
    protected $spoofedMethods = ['DELETE', 'PATCH', 'PUT'];

    /**
     * The name of the search field.
     *
     * @var string
     */
    protected $searchName = self::DEFAULT_SEARCH_NAME;

    /**
     * The default options.
     *
     * @var array
     */
    protected $defaultOptions = [
        'submitButton' => [
            'value' => '<i class="fa fa-search"></i>',
            'attributes' => [
                'class' => ['btn', 'btn-default']
            ],
            'container' => [
                'attributes' => [
                    'class' => 'input-group-btn'
                ]
            ]
        ],
        'searchField' => [
            'attributes' => [
                'class' => ['form-control', 'pull-right'],
            ]
        ],
        'container' => [
            'attributes' => [
                'class' => ['input-group', 'input-group-sm']
            ]
        ],
        'except' => [
            'page'
        ]
    ];

    /**
     * Create a new search form instance.
     *
     * @param null|string $searchName
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     * @param \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(?string $searchName = null, HtmlBuilder $html, FormBuilder $form, UrlGenerator $url, Request $request)
    {
        if (null !== $searchName) {
            $this->searchName = $searchName;
        }
        parent::__construct($html, $form, $url, $request);

        $this->form->considerRequest();
    }

    /**
     * Render the search form.
     *
     * @param array $options
     *
     * Example:
     *  $options = [
     *      'method' => 'get',
     *      'submitButton' => [
     *          'value' => '<i class="fa fa-search"></i>',
     *          'attributes' => [
     *              'class' => ['btn', 'btn-default']
     *          ],
     *          'container' => [
     *              'tag' => 'div',
     *              'attributes' => [
     *                  'class' => 'input-group-btn'
     *              ]
     *          ]
     *      ],
     *      'searchField' => [
     *          'name' => 'search',
     *          'attributes' => [
     *              'class' => ['form-control', 'pull-right'],
     *              'placeholder' => 'search'
     *          ]
     *      ],
     *      'container' => [
     *          'tag' => 'div',
     *          'attributes' => [
     *              'class' => ['input-group', 'input-group-sm']
     *          ]
     *      ],
     *      'except' => [
     *          'page'
     *      ]
     *  ];
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(array $options = []): HtmlString
    {
        $options = array_merge($this->defaultOptions, $options);

        $method = Arr::get($options, 'method', 'get');

        $attributes = [
            'method' => $this->getMethod($method),
            'action' => $this->getAction($options),
            'accept-charset' => 'UTF-8',
            'class' => 'search-form'
        ];

        $attributes = array_merge(
            $attributes, Arr::except($options, $this->reserved)
        );

        $prepend = $this->prependage($method);
        $content = $this->content(Arr::get($options, 'searchField', []), Arr::get($options, 'except', []));
        $submitButton = $this->submitButton(Arr::get($options, 'submitButton', []));

        $containerTag = Arr::get($options, 'container.tag', 'div');
        $containerAttributes = Arr::get($options, 'container.attributes', []);
        $content = $this->wrapWithTag($containerTag, $prepend . $content . $submitButton, $containerAttributes);

        return $this->toHtmlString('<form' . $this->html->attributes($attributes) . '>' . $content . '</form>');
    }

    /**
     * Parse the form action method.
     *
     * @param string $method
     *
     * @return string
     */
    protected function getMethod($method): string
    {
        $method = strtoupper($method);

        return $method !== 'GET' ? 'POST' : $method;
    }

    /**
     * Get the action from the options.
     *
     * @param array $options
     *
     * @return string
     */
    protected function getAction(array $options): string
    {
        if (isset($options['url'])) {
            return $this->getUrl($options['url']);
        } elseif (isset($options['route'])) {
            return $this->getRouteUrl($options['route']);
        } elseif (isset($options['action'])) {
            return $this->getControllerUrl($options['action']);
        }

        return $this->url->current();
    }

    /**
     * Get the form prependage for the given method.
     *
     * @param string $method
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function prependage($method): HtmlString
    {
        list($method, $prependage) = [strtoupper($method), ''];

        if (in_array($method, $this->spoofedMethods)) {
            $prependage .= $this->form->hidden('_method', $method);
        }

        if ($method !== 'GET') {
            $prependage .= $this->form->token();
        }

        return $this->toHtmlString($prependage);
    }

    /**
     * Get the form content.
     *
     * @param array $options
     * @param array $except
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function content(array $options = [], array $except = ['page']): HtmlString
    {
        $searchName = Arr::get($options, 'name', $this->searchName);
        $attributes = Arr::get($options, 'attributes', []);
        if (!Arr::exists($attributes, 'placeholder')) {
            $attributes['placeholder'] = __('macros.search_form.placeholder');
        }

        $content = '';
        $requestFields = array_filter(
            $this->request->except(
                array_map(function ($item) {
                    return to_dot_notation($item);
                }, array_merge([$searchName], $except))
            )
        );

        foreach ($requestFields as $name => $value) {
            $content .= $this->form->hidden($name, $value);
        }

        $content .= $this->form->text($searchName, $this->form->getValueAttribute($searchName), $attributes);

        return $this->toHtmlString($content);
    }

    /**
     * Get the form submit button.
     *
     * @param array|string|object $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function submitButton($options = []): HtmlString
    {
        if (is_string($options) || (is_object($options) && method_exists($options, '__toString'))) {
            return $this->toHtmlString((string)$options);
        }

        $value = Arr::get($options, 'value');
        $attributes = Arr::get($options, 'attributes');
        $containerTag = Arr::get($options, 'container.tag', 'div');
        $containerAttributes = Arr::get($options, 'container.attributes');

        $button = $this->form->button($value, array_merge($attributes, ['type' => 'submit']));

        return $this->wrapWithTag($containerTag, $button->toHtml(), $containerAttributes);
    }
}
