<?php

namespace App\Forms\User;

use App\Forms\Role\SelectForm;
use App\Models\Role;
use App\Models\Workspace;
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
        ])->add('role', 'entity', [
            'class' => Role::class,
            'property' => 'display_name',
            'empty_value' => ' ',
            'query_builder' => function (Role $role) {
                return $role->whereIn('name', [Role::ADMIN, Role::USER]);
            },
            'rules' => ['required', 'exists:roles,id']
        ])->add('workspace', 'entity', [
            'class' => Workspace::class,
            'property' => 'display_name',
            'empty_value' => ' ',
            'rules' => ['required', 'exists:workspaces,id']
        ])->add('password', 'repeated', [
            'rules' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }
}
