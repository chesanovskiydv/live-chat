<?php

namespace App\Http\Requests\Workspace;

use App\Http\Requests\BaseFormRequest;
use App\Models\Workspace;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Workspace\CreateForm as WorkspaceCreateForm;

class StoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Workspace::class);
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
        return $formBuilder->create(WorkspaceCreateForm::class);
    }
}
