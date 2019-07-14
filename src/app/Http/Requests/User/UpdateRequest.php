<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\User\EditForm as UserEditForm;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', User::class);
    }

    /**
     * Get the form instance.
     *
     * @param FormBuilder $formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    public function getFormInstance(FormBuilder $formBuilder): Form
    {
        return $formBuilder->create(UserEditForm::class, [
            'model' => $this->route('user')
        ]);
    }
}
