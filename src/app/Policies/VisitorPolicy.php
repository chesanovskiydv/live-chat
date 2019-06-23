<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the visitors.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('*-visitors', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can view the visitor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Visitor $visitor
     *
     * @return bool
     */
    public function view(User $user, Visitor $visitor)
    {
        return $user->hasPermission('view-visitors', $user->activeWorkspace())
            && $visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can create visitors.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-visitors', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can update the visitor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Visitor $visitor
     *
     * @return bool
     */
    public function update(User $user, Visitor $visitor)
    {
        return $user->hasPermission('update-visitors', $user->activeWorkspace())
            && $visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can delete the visitor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Visitor $visitor
     *
     * @return bool
     */
    public function delete(User $user, Visitor $visitor)
    {
        return $user->hasPermission('delete-visitors', $user->activeWorkspace())
            && $visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can restore the visitor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Visitor $visitor
     *
     * @return bool
     */
    public function restore(User $user, Visitor $visitor)
    {
        return $user->hasPermission('restore-visitors', $user->activeWorkspace())
            && $visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can permanently delete the visitor.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Visitor $visitor
     *
     * @return bool
     */
    public function forceDelete(User $user, Visitor $visitor)
    {
        return $user->hasPermission('force_delete-visitors', $user->activeWorkspace())
            && $visitor->workspace->is($user->activeWorkspace());
    }
}
