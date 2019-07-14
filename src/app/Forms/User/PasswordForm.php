<?php

namespace App\Forms\User;

use Kris\LaravelFormBuilder\Form;

class PasswordForm extends Form
{
    /**
     * @inheritdoc
     */
    public function buildForm()
    {
        $this->add('password', 'repeated', [
            'rules' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }
}
