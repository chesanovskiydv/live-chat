<?php

namespace App\Http\Requests\Workspace;

use App\Http\Requests\BaseFormRequest;

class EditRequest extends BaseFormRequest
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
}
