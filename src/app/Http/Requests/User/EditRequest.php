<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class EditRequest extends BaseFormRequest
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
}
