<?php

namespace App\Http\Requests;

use App\Concerns\Forms\ResolveValidator;
use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    use ResolveValidator;
}
