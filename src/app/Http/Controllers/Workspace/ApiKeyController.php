<?php

namespace App\Http\Controllers\Workspace;

use App\DataTables\WorkspaceApiKeysDataTable;
use App\Http\Controllers\Controller;
use App\Models\WorkspaceApiKey;
use App\Http\Requests\WorkspaceApiKey\{
    IndexRequest as IndexWorkspaceApiKeyRequest,
    CreateRequest as CreateWorkspaceApiKeyRequest,
    StoreRequest as StoreWorkspaceApiKeyRequest,
    EditRequest as EditWorkspaceApiKeyRequest,
    UpdateRequest as UpdateWorkspaceApiKeyRequest,
    DeleteRequest as DeleteWorkspaceApiKeyRequest
};
use App\Forms\WorkspaceApiKey\ {
    CreateForm as CreateWorkspaceApiKeyForm,
    EditForm as EditWorkspaceApiKeyForm
};
use App\Actions\WorkspaceApiKey\{
    Create as CreateWorkspaceApiKeyAction,
    Update as UpdateWorkspaceApiKeyAction,
    Delete as DeleteWorkspaceApiKeyAction
};

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexWorkspaceApiKeyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexWorkspaceApiKeyRequest $request)
    {
        return (new WorkspaceApiKeysDataTable())
            ->render('workspace::api-keys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateWorkspaceApiKeyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateWorkspaceApiKeyRequest $request)
    {
        return view('workspace::api-keys.create', [
            'form' => \FormBuilder::create(CreateWorkspaceApiKeyForm::class, [
                'method' => 'POST',
                'url' => route('workspace::api-keys.store'),
                'model' => WorkspaceApiKey::newModelInstance()
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkspaceApiKeyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkspaceApiKeyRequest $request)
    {
        $user = (new CreateWorkspaceApiKeyAction())
            ->run($request->all());

        if ($user) {
            flash(__('flash.successfully_created', ['item' => trans_choice('api_keys.api_key', 1)]))
                ->success()->important();
        }

        return redirect()->route('workspace::api-keys.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditWorkspaceApiKeyRequest $request
     * @param WorkspaceApiKey $workspaceApiKey
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EditWorkspaceApiKeyRequest $request, WorkspaceApiKey $workspaceApiKey)
    {
        return view('workspace::api-keys.edit', [
            'form' => \FormBuilder::create(EditWorkspaceApiKeyForm::class, [
                'method' => 'PUT',
                'url' => route('workspace::api-keys.update', ['api_key' => $workspaceApiKey]),
                'model' => $workspaceApiKey
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkspaceApiKeyRequest $request
     * @param WorkspaceApiKey $workspaceApiKey
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkspaceApiKeyRequest $request, WorkspaceApiKey $workspaceApiKey)
    {
        $isUpdated = (new UpdateWorkspaceApiKeyAction($workspaceApiKey))
            ->run($request->all());

        if ($isUpdated) {
            flash(__('flash.successfully_updated', ['item' => trans_choice('api_keys.api_key', 1)]))
                ->success()->important();
        }

        return redirect()->route('workspace::api-keys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteWorkspaceApiKeyRequest $request
     * @param WorkspaceApiKey $workspaceApiKey
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteWorkspaceApiKeyRequest $request, WorkspaceApiKey $workspaceApiKey)
    {
        $isDeleted = (new DeleteWorkspaceApiKeyAction($workspaceApiKey))
            ->run($request->all());

        if ($isDeleted) {
            flash(__('flash.successfully_deleted', ['item' => trans_choice('api_keys.api_key', 1)]))
                ->success()->important();
        }

        return redirect()->route('workspace::api-keys.index');
    }
}
