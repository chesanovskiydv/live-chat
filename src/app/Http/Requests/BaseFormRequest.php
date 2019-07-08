<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class BaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Create the validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory $factory
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(ValidationFactory $factory)
    {
        if (method_exists($this, 'getFormInstance')) {
            /** @var \Kris\LaravelFormBuilder\Form $form */
            $form = $this->container->call([$this, 'getFormInstance']);
            /** @var \Kris\LaravelFormBuilder\Rules $fieldRules */
            $fieldRules = $form->getFormHelper()->mergeFieldsRules($form->getFields());

            $rules = array_merge($fieldRules->getRules(), $this->container->call([$this, 'rules']));
            $messages = array_merge($fieldRules->getMessages(), $this->messages());
            $attributes = array_merge($fieldRules->getAttributes(), $this->attributes());

            return $factory->make(
                $this->validationData(), $rules,
                $messages, $attributes
            );
        }

        return $this->createDefaultValidator($factory);
    }
}
