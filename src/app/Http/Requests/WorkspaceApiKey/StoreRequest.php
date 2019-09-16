<?php

namespace App\Http\Requests\WorkspaceApiKey;

use App\Http\Requests\BaseFormRequest;
use App\Models\WorkspaceApiKey;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\WorkspaceApiKey\CreateForm as CreateWorkspaceApiKeyForm;

class StoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', WorkspaceApiKey::class);
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
        return $formBuilder->create(CreateWorkspaceApiKeyForm::class);
    }
}
