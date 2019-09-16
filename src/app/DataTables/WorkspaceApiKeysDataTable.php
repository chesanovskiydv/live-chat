<?php

namespace App\DataTables;

use App\Models\Workspace;
use App\Models\WorkspaceApiKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WorkspaceApiKeysDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumns(['created_at'])
            ->addColumn('action', function (WorkspaceApiKey $workspaceApiKey) {
                return \Html::actions([
                    'update' => ['url' => route('workspace::api-keys.edit', ['api_key' => $workspaceApiKey]), 'can' => ['update', $workspaceApiKey]],
                    'delete' => [
                        'url' => route("workspace::api-keys.destroy", ['api_key' => $workspaceApiKey]), 'method' => 'DELETE',
                        'can' => ['delete', $workspaceApiKey],
                        'when' => !$workspaceApiKey->trashed(),
                        'confirmation' => [
                            'title' => __('form.confirmation.delete.title'),
                            'text' => __('form.confirmation.delete.text'),
                        ]
                    ],
                ]);
            })->editColumn('is_active', function (WorkspaceApiKey $workspaceApiKey) {
                return $workspaceApiKey->is_active
                    ? new HtmlString('<span class="label label-success">' . __('api_keys.statuses.active') . '</span>')
                    : new HtmlString('<span class="label label-danger">' . __('api_keys.statuses.inactive') . '</span>');
            })->setRowAttr([
                'data-key' => function (WorkspaceApiKey $workspaceApiKey) {
                    return $workspaceApiKey->getKey();
                },
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WorkspaceApiKey $workspaceApiKey
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(WorkspaceApiKey $workspaceApiKey)
    {
        return $workspaceApiKey->newQuery()
            ->select('workspace_api_keys.id', 'workspace_api_keys.title', 'workspace_api_keys.is_active', 'workspace_api_keys.created_at', 'workspace_api_keys.workspace_id')
            ->when(\Auth::user()->activeWorkspace(), function (Builder $query, Workspace $workspace) {
                $query->where('workspace_api_keys.workspace_id', $workspace->getKey());
            })
            ->with('workspace');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $columns = $this->getColumns();

        return $this->builder()
            ->setTableId('workspace-api-keys-table')
            ->columns($columns)
            ->minifiedAjax()
            ->addAction(['title' => __('grid.action_column'), 'class' => 'actions'])
            ->parameters($this->getBuilderParameters())
            ->orderBy(array_key_last($columns), 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            new Column([
                    'data' => config('datatables.index_column'), 'name' => config('datatables.index_column'),
                    'title' => __('grid.key_column'),
                    'orderable' => false, 'searchable' => false, 'exportable' => false]
            ),
            new Column(['data' => 'title', 'name' => 'workspace_api_keys.title', 'title' => __('api_keys.title')]),
            new Column(['data' => 'is_active', 'name' => 'workspace_api_keys.is_active', 'title' => __('api_keys.status')]),
            new Column(['data' => 'created_at', 'name' => 'workspace_api_keys.created_at', 'title' => __('api_keys.created_at'), 'searchable' => false]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Workspace_Api_Keys_' . date('YmdHis');
    }
}
