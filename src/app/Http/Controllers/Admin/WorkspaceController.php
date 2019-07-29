<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WorkspacesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Http\Requests\Workspace\{
    IndexRequest as IndexWorkspaceRequest,
    CreateRequest as CreateWorkspaceRequest,
    StoreRequest as StoreWorkspaceRequest,
    EditRequest as EditWorkspaceRequest,
    UpdateRequest as UpdateWorkspaceRequest,
    DeleteRequest as DeleteWorkspaceRequest
};
use App\Forms\Workspace\ {
    CreateForm as CreateWorkspaceForm,
    EditForm as EditWorkspaceForm
};
use App\Actions\Workspace\{
    Create as CreateWorkspaceAction,
    Update as UpdateWorkspaceAction,
    Delete as DeleteWorkspaceAction
};

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexWorkspaceRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexWorkspaceRequest $request)
    {
        return (new WorkspacesDataTable())
            ->render('admin::workspaces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateWorkspaceRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateWorkspaceRequest $request)
    {
        return view('admin::workspaces.create', [
            'form' => \FormBuilder::create(CreateWorkspaceForm::class, [
                'method' => 'POST',
                'url' => route('admin::workspaces.store'),
            ]),
            'workspace' => Workspace::newModelInstance()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkspaceRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkspaceRequest $request)
    {
        $workspace = (new CreateWorkspaceAction())
            ->run($request->all());

        if ($workspace) {
            flash(__('flash.successfully_created', ['item' => trans_choice('workspaces.workspace', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::workspaces.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditWorkspaceRequest $request
     * @param Workspace $workspace
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EditWorkspaceRequest $request, Workspace $workspace)
    {
        return view('admin::workspaces.edit', [
            'form' => \FormBuilder::create(EditWorkspaceForm::class, [
                'method' => 'PUT',
                'url' => route('admin::workspaces.update', ['workspace' => $workspace]),
                'model' => $workspace
            ]),
            'workspace' => $workspace
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkspaceRequest $request
     * @param Workspace $workspace
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkspaceRequest $request, Workspace $workspace)
    {
        $isUpdated = (new UpdateWorkspaceAction($workspace))
            ->run($request->all());

        if ($isUpdated) {
            flash(__('flash.successfully_updated', ['item' => trans_choice('workspaces.workspace', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::workspaces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteWorkspaceRequest $request
     * @param Workspace $workspace
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteWorkspaceRequest $request, Workspace $workspace)
    {
        $isDeleted = (new DeleteWorkspaceAction($workspace))
            ->run($request->all());

        if ($isDeleted) {
            flash(__('flash.successfully_deleted', ['item' => trans_choice('workspaces.workspace', 1)]))
                ->success()->important();
        }

        return redirect()->route('admin::workspaces.index');
    }
}
