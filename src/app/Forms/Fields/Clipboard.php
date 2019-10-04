<?php
declare(strict_types=1);

namespace App\Forms\Fields;

use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Fields\FormField;

class Clipboard extends FormField
{
    /**
     * @var string
     */
    const ACTION_COPY = 'copy';

    /**
     * Cut action only works on <input> or <textarea> elements
     *
     * @var string
     */
    const ACTION_CUT = 'cut';

    /**
     * @var string
     */
    const DEFAULT_CLASS = 'clipboard-js';

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/partials/fields/clipboard.blade.php
        return 'partials.fields.clipboard';
    }

    /**
     * @inheritdoc
     */
    public function render(array $options = [], $showLabel = true, $showField = true, $showError = false)
    {
        $this->setupClipboardOptions($options);
        return parent::render($options, $showLabel, $showField, $showError);
    }

    /**
     * Setup clipboard field options.
     *
     * @param array $options
     *
     * @return void
     */
    protected function setupClipboardOptions(&$options)
    {
        if (Arr::has($this->options, 'target')) {
            $options['input'] = false;
            $clipboardOptions = Arr::only($this->options, ['target', 'action']);
        } elseif ($this->getOption('action') === self::ACTION_CUT) {
            $clipboardOptions = [
                'action' => $this->getOption('action'),
                'target' => sprintf("[name='%s']", addcslashes($this->getName(), '[]'))
            ];
        } else {
            $clipboardOptions = ['text' => $this->getOption('value')];
        }

        $options['clipboardAttrs'] = $this->formHelper->prepareAttributes(
            collect($clipboardOptions)
                ->mapWithKeys(function ($value, $key) {
                    return ["data-clipboard-{$key}" => $value];
                })->toArray()
        );

        if ($this->getOption('action') === self::ACTION_CUT) {
            Arr::set($options, 'attr.readonly', false);
        }
    }

    /**
     * @inheritdoc
     */
    protected function getDefaults()
    {
        return [
            'input' => true,
            'attr' => [
                'readonly' => true,
                'onfocus' => "this.select()"
            ]
        ];
    }
}
