<?php

namespace App\Http\Requests\WorkspaceApiKey;

use App\Http\Requests\BaseFormRequest;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\WorkspaceApiKey\EditForm as EditWorkspaceApiKeyForm;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('api_key'));
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
        return $formBuilder->create(EditWorkspaceApiKeyForm::class, [
            'model' => $this->route('api_key')
        ]);
    }
}
