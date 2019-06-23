<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkspaceApiKey;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspaceApiKeyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the api keys.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('*-api_keys', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can view the workspace api key.
     *
     * @param \App\Models\User $user
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return bool
     */
    public function view(User $user, WorkspaceApiKey $workspaceApiKey)
    {
        return $user->hasPermission('view-api_keys', $user->activeWorkspace())
            && $workspaceApiKey->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can create workspace api keys.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-api_keys', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can update the workspace api key.
     *
     * @param \App\Models\User $user
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return bool
     */
    public function update(User $user, WorkspaceApiKey $workspaceApiKey)
    {
        return $user->hasPermission('update-api_keys', $user->activeWorkspace())
            && $workspaceApiKey->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can delete the workspace api key.
     *
     * @param \App\Models\User $user
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return bool
     */
    public function delete(User $user, WorkspaceApiKey $workspaceApiKey)
    {
        return $user->hasPermission('delete-api_keys', $user->activeWorkspace())
            && $workspaceApiKey->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can restore the workspace api key.
     *
     * @param \App\Models\User $user
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return bool
     */
    public function restore(User $user, WorkspaceApiKey $workspaceApiKey)
    {
        return $user->hasPermission('restore-api_keys', $user->activeWorkspace())
            && $workspaceApiKey->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can permanently delete the workspace api key.
     *
     * @param \App\Models\User $user
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return bool
     */
    public function forceDelete(User $user, WorkspaceApiKey $workspaceApiKey)
    {
        return $user->hasPermission('force_delete-api_keys', $user->activeWorkspace())
            && $workspaceApiKey->workspace->is($user->activeWorkspace());
    }
}
