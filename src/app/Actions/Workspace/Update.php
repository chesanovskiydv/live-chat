<?php

namespace App\Actions\Workspace;

use App\Concerns\Actions\HasModel;
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
        return $this->user()->can('update', $this->getModel());
    }

    /**
     * Execute the action.
     *
     * @return bool
     */
    public function handle()
    {
        return $this->getModel()
            ->update(
                $this->only(['display_name', 'description'])
            );
    }
}
