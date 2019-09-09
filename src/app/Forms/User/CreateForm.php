<?php

namespace App\Forms\User;

use App\Models\Role;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Builder;
use Kris\LaravelFormBuilder\Form;

class CreateForm extends Form
{
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
                return $role->newQuery()->whereIn('roles.name', [Role::ADMIN, Role::USER]);
            },
            'rules' => ['required', 'exists:roles,id']
        ])->add('workspace', 'entity', [
            'class' => Workspace::class,
            'property' => 'display_name',
            'empty_value' => ' ',
            'rules' => ['required', 'exists:workspaces,id'],
            'query_builder' => function (Workspace $workspace) {
                return $workspace->newQuery()->when(!\Auth::user()->hasRole(Role::SUPER_ADMIN), function(Builder $query) {
                    $query->where('workspaces.id', \Auth::user()->workspaces->modelKeys());
                });
            },
        ])->compose(PasswordForm::class);

        if(!\Auth::user()->hasRole(Role::SUPER_ADMIN)) {
            $this->exclude(['workspace']);
        }
    }
}
