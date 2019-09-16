<?php

namespace App\Http\Requests\WorkspaceApiKey;

use App\Http\Requests\BaseFormRequest;

class DeleteRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete', $this->route('api_key'));
    }
}
