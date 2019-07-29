<?php

namespace App\Forms\Workspace;

use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{
    /**
     * @inheritdoc
     */
    public function buildForm()
    {
        $this->add('display_name', 'text', [
            'rules' => ['required', 'string', 'min:2', 'max:255'],
        ])->add('description', 'textarea', [
            'rules' => ['nullable', 'string', 'min:2', 'max:255'],
        ]);
    }
}
