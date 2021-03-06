<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\{
    IndexRequest as IndexUserRequest,
    CreateRequest as CreateUserRequest,
    StoreRequest as StoreUserRequest,
    EditRequest as EditUserRequest,
    UpdateRequest as UpdateUserRequest,
    DeleteRequest as DeleteUserRequest
};
use App\Forms\User\ {
    CreateForm as CreateUserForm,
    EditForm as EditUserForm
};
use App\Actions\User\{
    Create as CreateUserAction,
    Update as UpdateUserAction,
    Delete as DeleteUserAction
};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexUserRequest $request)
    {
        return (new UsersDataTable())
            ->render('admin::users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        return view('admin::users.create', [
            'form' => \FormBuilder::create(CreateUserForm::class, [
                'method' => 'POST',
                'url' => route('admin::users.store'),
            ]),
            'user' => User::newModelInstance()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = (new CreateUserAction())
            ->run($request->all());

        if ($user) {
            flash(__('flash.successfully_created', ['item' => trans_choice('users.user', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditUserRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EditUserRequest $request, User $user)
    {
        return view('admin::users.edit', [
            'form' => \FormBuilder::create(EditUserForm::class, [
                'method' => 'PUT',
                'url' => route('admin::users.update', ['user' => $user]),
                'model' => $user
            ]),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest|\Illuminate\Http\Request $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $isUpdated = (new UpdateUserAction($user))
            ->run($request->all());

        if ($isUpdated) {
            flash(__('flash.successfully_updated', ['item' => trans_choice('users.user', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteUserRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $isDeleted = (new DeleteUserAction($user))
            ->run($request->all());

        if ($isDeleted) {
            flash(__('flash.successfully_deleted', ['item' => trans_choice('users.user', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::users.index');
    }
}
