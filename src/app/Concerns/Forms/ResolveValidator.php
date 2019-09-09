<?php

namespace App\Concerns\Forms;

use DeepCopy\Reflection\ReflectionHelper;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Form;

trait ResolveValidator
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
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->all();
    }

    /**
     * Create the validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(ValidationFactory $factory)
    {
        if (method_exists($this, 'getFormInstance')) {
            /** @var \Kris\LaravelFormBuilder\Form $form */
            $form = app()->call([$this, 'getFormInstance']);
            /** @var \Kris\LaravelFormBuilder\Rules $fieldRules */
            $fieldRules = $form->getFormHelper()->mergeFieldsRules($form->getFields());

            $rules = array_merge(
                Arr::except($fieldRules->getRules(), $this->getExtraProperty($form)),
                app()->call([$this, 'rules'])
            );
            $messages = array_merge($fieldRules->getMessages(), $this->messages());
            $attributes = array_merge($fieldRules->getAttributes(), $this->attributes());

            return $factory->make(
                $this->validationData(), $rules,
                $messages, $attributes
            );
        }

        return $this->createDefaultValidator($factory);
    }

    /**
     * Create the default validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->validationData(), $this->rules(),
            $this->messages(), $this->attributes()
        );
    }

    /**
     * Retrieves "exclude" property from form instance.
     *
     * @param Form $form
     *
     * @return mixed
     */
    protected function getExtraProperty(Form $form)
    {
        $reflectionProperty = ReflectionHelper::getProperty($form, 'exclude');
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($form);
    }
}
