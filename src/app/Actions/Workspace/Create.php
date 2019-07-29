<?php

namespace App\Actions\Workspace;

use App\Models\Workspace;
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
        return $this->user()->can('create', Workspace::class);
    }

    /**
     * Execute the action.
     *
     * @return \App\Models\Workspace
     */
    public function handle()
    {
        return Workspace::create(
            $this->only(['display_name', 'description'])
        );
    }
}
