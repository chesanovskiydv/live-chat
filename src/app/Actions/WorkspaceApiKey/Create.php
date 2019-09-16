<?php

namespace App\Actions\WorkspaceApiKey;

use App\Models\Role;
use App\Models\Workspace;
use App\Models\WorkspaceApiKey;
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
        return $this->user()->can('create', WorkspaceApiKey::class);
    }

    /**
     * Execute the action.
     *
     * @return \App\Models\WorkspaceApiKey|\Illuminate\Database\Eloquent\Model
     */
    public function handle()
    {
        /** @var Workspace $workspace */
        $workspace = \Auth::user()->hasRole(Role::SUPER_ADMIN)
            ? Workspace::whereKey($this->get('workspace'))->firstOrFail()
            : \Auth::user()->activeWorkspace();

        return $workspace->workspaceApiKeys()->create(
            array_merge(['is_active' => false], $this->only(['title', 'is_active']))
        );
    }
}
