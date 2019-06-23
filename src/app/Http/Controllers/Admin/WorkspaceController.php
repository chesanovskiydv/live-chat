<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Requests\Workspace\{
    Index as IndexWorkspaceRequest
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
        if ($request->expectsJson()) {
            return \DataTables::of(Workspace::query())
                ->addIndexColumn()
                ->addColumn('action', function (Workspace $workspace) {
                    return \ Html::actions([
                        'view' => ['url' => route('admin::workspaces.show', ['workspace' => $workspace]), 'can' => ['view', $workspace]],
                        'update' => ['url' => route('admin::workspaces.edit', ['workspace' => $workspace]), 'can' => ['update', $workspace]],
                        'delete' => [
                            'url' => route('admin::workspaces.destroy', ['workspace' => $workspace]), 'method' => 'DELETE',
                            'can' => ['delete', $workspace],
                            'confirmation' => [
                                'title' => __('form.confirmation.delete.title'),
                                'text' => __('form.confirmation.delete.text'),
                            ]
                        ],
                    ]);
                })
                ->make(true);
        }

        return view('admin.workspace.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
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
     *
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
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
