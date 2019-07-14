<?php

namespace App\Actions\User;

use App\Concerns\Actions\HasModel;
use App\Models\Role;
use App\Models\User;
use Lorisleiva\Actions\Action;

class Update extends Action
{
    use HasModel;

    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', User::class);
    }

    /**
     * Execute the action.
     *
     * @return bool
     */
    public function handle()
    {
        return \DB::transaction(function () {
            $role = Role::whereKey($this->get('role'))->firstOrFail();

            return $this->getModel()
                ->syncRoles([$role], $this->getModel()->activeWorkspace())
                ->update($this->only(['name']));
        });
    }
}
