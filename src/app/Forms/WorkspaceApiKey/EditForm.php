<?php

namespace App\Forms\WorkspaceApiKey;

use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{
    /**
     * @inheritdoc
     */
    public function buildForm()
    {
        $this->add('title', 'text', [
            'rules' => ['required', 'string', 'min:2', 'max:64'],
        ])->add('is_active', 'checkbox', [
            'rules' => ['boolean']
        ]);
    }
}
