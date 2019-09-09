<?php

namespace App\Actions\User;

use App\Models\Role;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Action;

class Create extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Execute the action.
     *
     * @return \App\Models\User
     */
    public function handle()
    {
        return \DB::transaction(function () {
            $role = Role::whereKey($this->get('role'))->firstOrFail();
            $workspace = \Auth::user()->hasRole(Role::SUPER_ADMIN)
                ? Workspace::whereKey($this->get('workspace'))->firstOrFail()
                : \Auth::user()->activeWorkspace();
            $password = Hash::make($this->get('password'));

            return User::create(array_merge(
                $this->only(['name', 'email']),
                ['password' => $password]
            ))->attachRole($role, $workspace);
        });
    }
}
