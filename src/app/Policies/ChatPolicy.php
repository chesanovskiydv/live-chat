<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the chats.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function list(User $user)
    {
        return $user->hasPermission('*-chats', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can view the chat.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Chat $chat
     *
     * @return bool
     */
    public function view(User $user, Chat $chat)
    {
        return $user->hasPermission('view-chats', $user->activeWorkspace())
            && $chat->visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can create chats.
     *
     * @param  \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-chats', $user->activeWorkspace());
    }

    /**
     * Determine whether the user can update the chat.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Chat $chat
     *
     * @return bool
     */
    public function update(User $user, Chat $chat)
    {
        return $user->hasPermission('update-chats', $user->activeWorkspace())
            && $chat->visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can delete the chat.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Chat $chat
     *
     * @return bool
     */
    public function delete(User $user, Chat $chat)
    {
        return $user->hasPermission('delete-chats', $user->activeWorkspace())
            && $chat->visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can restore the chat.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Chat $chat
     *
     * @return bool
     */
    public function restore(User $user, Chat $chat)
    {
        return $user->hasPermission('restore-chats', $user->activeWorkspace())
            && $chat->visitor->workspace->is($user->activeWorkspace());
    }

    /**
     * Determine whether the user can permanently delete the chat.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Chat $chat
     *
     * @return bool
     */
    public function forceDelete(User $user, Chat $chat)
    {
        return $user->hasPermission('force_delete-chats', $user->activeWorkspace())
            && $chat->visitor->workspace->is($user->activeWorkspace());
    }
}
