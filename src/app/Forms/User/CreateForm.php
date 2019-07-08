<?php

namespace App\Forms\User;

use Kris\LaravelFormBuilder\Form;

class CreateForm extends Form
{
    public function __construct()
    {
        $this->setMethod('POST');
        $this->setUrl(route('admin::users.store'));
    }

    /**
     * @inheritdoc
     */
    public function buildForm()
    {
        $this->add('name', 'text', [
            'rules' => ['required', 'string', 'min:2', 'max:255'],
        ])->add('email', 'email', [
            'rules' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }
}
