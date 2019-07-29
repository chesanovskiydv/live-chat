<?php

namespace App\Http\Requests\Workspace;

use App\Http\Requests\BaseFormRequest;
use App\Models\Workspace;

class IndexRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('viewAny', Workspace::class);
    }
}
