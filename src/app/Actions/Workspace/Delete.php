<?php

namespace App\Actions\Workspace;

use App\Concerns\Actions\HasModel;
use App\Models\Workspace;
use Lorisleiva\Actions\Action;

class Delete extends Action
{
    use HasModel;

    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete', Workspace::class);
    }

    /**
     * Execute the action.
     *
     * @return bool
     */
    public function handle()
    {
        return $this->getModel()
            ->delete();
    }
}
