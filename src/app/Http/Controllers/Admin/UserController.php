<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\{
    IndexRequest as IndexUserRequest,
    CreateRequest as CreateUserRequest,
    StoreRequest as StoreUserRequest
};
use App\Forms\User\ {
    CreateForm as CreateUserForm
};
use App\Actions\User\{
    Create as CreateUserAction
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
            'form' => \FormBuilder::create(CreateUserForm::class),
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
