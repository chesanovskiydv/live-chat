<?php

namespace App\Forms\User;

use App\Models\Role;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Builder;
use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{
    /**
     * @inheritdoc
     */
    public function buildForm()
    {
        $this->add('name', 'text', [
            'rules' => ['required', 'string', 'min:2', 'max:255'],
        ])->add('email', 'email', [
            'attr' => ['disabled' => true]
        ])->add('role', 'entity', [
            'class' => Role::class,
            'property' => 'display_name',
            'empty_value' => ' ',
            'query_builder' => function (Role $role) {
                return $role->newQuery()->whereIn('name', [Role::ADMIN, Role::USER]);
            },
            'selected' => $this->model->roles,
            'rules' => ['required', 'exists:roles,id']
        ])->add('workspace', 'entity', [
            'class' => Workspace::class,
            'property' => 'display_name',
            'empty_value' => ' ',
            'selected' => $this->model->workspaces,
            'attr' => ['disabled' => true],
            'query_builder' => function (Workspace $workspace) {
                return $workspace->newQuery()->when(!\Auth::user()->hasRole(Role::SUPER_ADMIN), function(Builder $query) {
                    $query->where('workspaces.id', \Auth::user()->workspaces->modelKeys());
                });
            },
        ]);

        if(!\Auth::user()->hasRole(Role::SUPER_ADMIN)) {
            $this->exclude(['workspace']);
        }
    }
}
