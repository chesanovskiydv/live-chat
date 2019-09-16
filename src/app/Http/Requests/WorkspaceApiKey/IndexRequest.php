<?php

namespace App\Http\Requests\WorkspaceApiKey;

use App\Http\Requests\BaseFormRequest;
use App\Models\WorkspaceApiKey;

class IndexRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('viewAny', WorkspaceApiKey::class);
    }
}
