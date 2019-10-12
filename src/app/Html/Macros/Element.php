<?php
declare(strict_types=1);

namespace App\Html\Macros;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Traits\Macroable;

class Element extends BaseMacros
{
    use Macroable;

    /**
     * @param string $element
     * @param array ...$parameters
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(string $element, ...$parameters): HtmlString
    {
        return call_user_func_array([$this, $element], $parameters);
    }

    /**
     * Create a label element.
     *
     * @param string $type Type can be: success, warning, danger, info.
     * @param string $content
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function label(string $type, string $content): HtmlString
    {
        $attributes = $this->html->attributes(['class' => ['label', "label-{$type}"]]);

        return $this->toHtmlString('<span' . $attributes . '>' . $content . '</span>');
    }
}
