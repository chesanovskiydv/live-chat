<?php

namespace App\Actions\User;

use App\Concerns\Actions\HasModel;
use App\Models\User;
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
        return $this->user()->can('delete', User::class);
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
