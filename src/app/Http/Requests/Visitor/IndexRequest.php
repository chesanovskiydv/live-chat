<?php

namespace App\Http\Requests\Visitor;

use App\Http\Requests\BaseFormRequest;
use App\Models\Visitor;

class IndexRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('viewAny', Visitor::class);
    }
}
