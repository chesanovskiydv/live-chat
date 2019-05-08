<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
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
     * Determine whether the user can list the workspaces.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function list(User $user)
    {
        return $user->hasPermission('*-workspaces', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can view the workspace.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Workspace $workspace
     *
     * @return bool
     */
    public function view(User $user, Workspace $workspace)
    {
        return $user->hasPermission('view-workspaces', $user->activeWorkspace())
            && $workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can create workspaces.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-workspaces', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can update the workspace.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Workspace $workspace
     *
     * @return bool
     */
    public function update(User $user, Workspace $workspace)
    {
        return $user->hasPermission('update-workspaces', $user->activeWorkspace())
            && $workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can delete the workspace.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Workspace $workspace
     *
     * @return bool
     */
    public function delete(User $user, Workspace $workspace)
    {
        return $user->hasPermission('delete-workspaces', $user->activeWorkspace())
            && $workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can restore the workspace.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Workspace $workspace
     *
     * @return bool
     */
    public function restore(User $user, Workspace $workspace)
    {
        return $user->hasPermission('restore-workspaces', $user->activeWorkspace())
            && $user->workspaces()->whereKey($workspace->getKey())->exists();
    }

    /**
     * Determine whether the user can permanently delete the workspace.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Workspace $workspace
     *
     * @return bool
     */
    public function forceDelete(User $user, Workspace $workspace)
    {
        return $user->hasPermission('force_delete-workspaces', $user->activeWorkspace())
            && $workspace->is($user->activeWorkspace());
    }
}
