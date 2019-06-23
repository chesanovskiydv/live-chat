<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $ability
     * @param null $target
     *
     * @return bool
     */
    public function before(User $user, $ability, $target = null)
    {
        if ($user->hasRole(Role::SUPER_ADMIN)) {
            return true;
        } elseif ($user->activeWorkspace() === null) {
            return false;
        }
    }

    /**
     * Determine whether the user can list the users.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('*-users', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function view(User $user, User $model)
    {
        return $user->hasPermission('view-users', $user->activeWorkspace())
            && $model->workspaces()->whereKey($user->activeWorkspace()->getKey())->exists();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-users', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function update(User $user, User $model)
    {
        return $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermission('delete-users', $user->activeWorkspace())
            && $model->workspaces()->whereKey($user->activeWorkspace()->getKey())->exists();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function restore(User $user, User $model)
    {
        return $user->isNot($model)
            && $user->hasPermission('restore-users', $user->activeWorkspace())
            && $model->workspaces()->whereKey($user->activeWorkspace()->getKey())->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->isNot($model)
            && $user->hasPermission('force_delete-users', $user->activeWorkspace())
            && $model->workspaces()->whereKey($user->activeWorkspace()->getKey())->exists();
    }
}
