<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Auth\Access\Gate;

class Actions extends BaseMacros
{
    /**
     * The gate instance.
     *
     * @var \Illuminate\Contracts\Auth\Access\Gate
     */
    protected $gate;

    /**
     * A string that should be prepended to attributes.
     *
     * @var string
     */
    protected $prefix = 'data-action-form';

    /**
     * Create a new macros instance.
     *
     * @param HtmlBuilder $html
     * @param FormBuilder $form
     * @param UrlGenerator $url
     * @param Request $request
     * @param Gate $gate
     */
    public function __construct(HtmlBuilder $html, FormBuilder $form, UrlGenerator $url, Request $request, Gate $gate)
    {
        $this->gate = $gate;

        parent::__construct($html, $form, $url, $request);
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(array $options = []): HtmlString
    {
        $actions = [];

        foreach ($options as $action => $parameters) {
            if (is_array($parameters)) {
                $url = Arr::pull($parameters, 'url');
            } else {
                [$url, $parameters] = [$parameters, []];
            }

            if (Arr::has($parameters, 'can')) {
                if (!call_user_func_array([$this, 'can'], Arr::get($parameters, 'can'))) {
                    continue;
                }
            }

            $method = strtolower($action) . "Action";

            $actions[] = method_exists($this, $method)
                ? call_user_func([$this, $method], $url, $parameters)
                : $this->customAction($url, $parameters);
        }

        return $this->toHtmlString(implode('', $actions));
    }

    /**
     * Get the custom action html.
     *
     * @param string $url
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function customAction(string $url, array $options = []): HtmlString
    {
        $parameters = ['url' => $url];

        $methodReflection = new \ReflectionMethod($this, 'actionButton');
        foreach ($methodReflection->getParameters() as $parameter) {
            if (Arr::has($parameters, $parameter->getName())) {
                continue;
            }

            if (Arr::has($options, $parameter->getName())) {
                $parameters[$parameter->getName()] = Arr::get($options, $parameter->getName());
            } elseif ($parameter->isDefaultValueAvailable()) {
                $parameters[$parameter->getName()] = $parameter->getDefaultValue();
            }

        };

        [$method, $confirmation, $form] = [
            strtoupper(Arr::get($options, 'method', 'GET')),
            Arr::get($options, 'confirmation', false),
            ''
        ];

        if ($method !== 'GET' || $confirmation) {
            $formId = self::getFormKey();
            $form = $this->actionForm($url, $method, [
                'id' => $formId
            ]);

            $parameters['url'] = null;
            $parameters['attributes']["{$this->prefix}-key"] = $formId;
            if ($confirmation) {
                $parameters['attributes'] = array_merge($parameters['attributes'], $this->getConfirmationAttributes($confirmation));
            }
        }

        $button = call_user_func_array([$this, 'actionButton'], $parameters);

        return $this->toHtmlString($button . $form);
    }

    /**
     * Get the form key attribute.
     *
     * @return string
     */
    public static function getFormKey(): string
    {
        return sprintf("action-form-%s", Str::uuid());
    }

    /**
     * Get the confirmation attributes.
     *
     * @param array|boolean $confirmation
     *
     * @return array
     */
    protected function getConfirmationAttributes($confirmation): array
    {
        return [
            "{$this->prefix}-confirmation-title" => Arr::get($confirmation, 'title', __('macros.search_form.confirmation_title')),
            "{$this->prefix}-confirmation-text" => Arr::get($confirmation, 'text', __('macros.search_form.confirmation_text'))
        ];
    }

    /**
     * Get the "view" action html.
     *
     * @param string $url
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function viewAction(string $url, array $options = []): HtmlString
    {
        $defaults = ['title' => '<span class="fa fa-fw fa-eye"></span>'];

        $options = array_merge($defaults, $options);

        return $this->customAction($url, $options);
    }

    /**
     * Get the "update" action html.
     *
     * @param string $url
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function updateAction(string $url, array $options = []): HtmlString
    {
        $defaults = ['title' => '<span class="fa fa-fw fa-pencil"></span>'];

        $options = array_merge($defaults, $options);

        return $this->customAction($url, $options);
    }

    /**
     * Get the "delete" action html.
     *
     * @param string $url
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function deleteAction(string $url, array $options = []): HtmlString
    {
        $defaults = ['title' => '<span class="fa fa-fw fa-trash-o"></span>'];

        $options = array_merge($defaults, $options);

        return $this->customAction($url, $options);
    }

    /**
     * Get the action button.
     *
     * @param string|null $url
     * @param string|null $title
     * @param array $attributes
     * @param bool|null $secure
     * @param bool $escape
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function actionButton(?string $url, ?string $title = '<span class="fa fa-fw fa-link"></span>', array $attributes = [], ?bool $secure = null, bool $escape = false): HtmlString
    {
        $defaults = ['class' => 'action-link'];

        $attributes = array_merge($defaults, $attributes);

        return $this->html->link($url ?? '#', $title, $attributes, $secure, $escape);
    }

    /**
     * Get the action form.
     *
     * @param string $url
     * @param string $method
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function actionForm(string $url, string $method = 'GET', array $options = []): HtmlString
    {
        $defaults = ['class' => 'action-form'];

        $options = array_merge($defaults, $options, ['url' => $url, 'method' => $method]);

        return $this->toHtmlString($this->form->open($options) . $this->form->close());
    }

    /**
     * @param string $ability
     * @param array|mixed $arguments
     *
     * @return bool
     */
    protected function can(string $ability, $arguments = []): bool
    {
        return $this->gate->allows($ability, $arguments);
    }
}
