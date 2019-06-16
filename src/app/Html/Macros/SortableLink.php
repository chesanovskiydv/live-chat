<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Str;

class SortableLink extends BaseMacros
{
    const ASCENDING = 'asc';
    const DESCENDING = 'desc';

    /**
     * The default name of the sort parameter.
     *
     * @var string
     */
    const DEFAULT_PARAMETER = 'sort';

    /**
     * The name of the sort parameter.
     *
     * @var string
     */
    protected $sortParameter = self::DEFAULT_PARAMETER;

    /**
     * The ordering direction.
     *
     * @var string
     */
    protected $defaultDirection = self::ASCENDING;

    /**
     * Indicates if the sort should be allowed in multiple mode.
     *
     * @var bool
     */
    protected $multiple = false;

    /**
     * Create a new sortable link instance.
     *
     * @param null|string $sortParameter
     * @param string $defaultDirection
     * @param bool $multiple
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     * @param \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(?string $sortParameter = null, ?string $defaultDirection = null, bool $multiple = false, HtmlBuilder $html, FormBuilder $form, UrlGenerator $url, Request $request)
    {
        $this->sortParameter = $sortParameter ?? $this->sortParameter;
        $this->defaultDirection = $defaultDirection ?? $this->defaultDirection;
        $this->multiple = $multiple;

        parent::__construct($html, $form, $url, $request);
    }

    /**
     * @param string $attribute
     * @param string $label
     * @param string $defaultSorting
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(string $attribute, string $label, string $defaultSorting = null): HtmlString
    {
        $sorts = $this->sorts();

        $currentAttributeKey = $sorts->search(function (string $sortAttribute) use ($attribute) {
            return ltrim($sortAttribute, '-') === $attribute;
        });
        $currentDirection = null;
        $newDirection = $this->defaultDirection;

        if ($currentAttributeKey !== false) {
            $currentDirection = (Str::startsWith($sorts->get($currentAttributeKey), '-') ? self::DESCENDING : self::ASCENDING);
        } elseif ($sorts->isEmpty() && null !== $defaultSorting) {
            $currentDirection = $defaultSorting;
        }

        $class = ['sorting'];
        if(null !== $currentDirection) {
            $newDirection = $currentDirection === self::DESCENDING ? self::ASCENDING : self::DESCENDING;
            $class[] = $currentDirection === self::ASCENDING ? 'sorting_asc' : 'sorting_desc';
        }

        $newAttribute = $this->getSortAttribute($attribute, $newDirection === self::DESCENDING);

        return $this->link($this->request->fullUrlWithQuery([
            $this->sortParameter => $this->multiple
                ? $sorts->put($currentAttributeKey, $newAttribute)->toArray()
                : $newAttribute
        ]), $label, ['class' => $class]);
    }

    /**
     * Get sort parameters.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function sorts(): Collection
    {
        $sortParts = $this->request->query($this->sortParameter);

        if (is_string($sortParts)) {
            $sortParts = explode(',', $sortParts);
        }

        return collect($sortParts)->filter();
    }

    /**
     * Get parameter string for sorting by attribute.
     *
     * @param string $attribute
     * @param bool $descending
     *
     * @return string
     */
    protected function getSortAttribute(string $attribute, bool $descending = false): string
    {
        return $descending ? "-" . $attribute : $attribute;
    }

    /**
     * Generate a HTML link.
     *
     * @param string $url
     * @param null|string $title
     * @param array $attributes
     * @param bool|null $secure
     * @param bool $escape
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function link(string $url, ?string $title = null, array $attributes = [], ?bool $secure = null, bool $escape = true): HtmlString
    {
        return $this->html->link($url, $title, $attributes, $secure, $escape);
    }
}
