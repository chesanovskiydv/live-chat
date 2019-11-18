<?php

namespace App\Http\Requests\Workspace;

use App\Http\Requests\BaseFormRequest;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Workspace\EditForm as EditWorkspaceForm;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('workspace'));
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
        return $formBuilder->create(EditWorkspaceForm::class, [
            'model' => $this->route('workspace')
        ]);
    }
}