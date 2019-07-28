<?php

namespace App\DataTables;

use App\Models\Workspace;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WorkspacesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumns(['created_at'])
            ->addColumn('action', function (Workspace $workspace) {
                return \Html::actions([
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
            })->setRowAttr([
                'data-key' => function (Workspace $user) {
                    return $user->getKey();
                },
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Workspace $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workspace $model)
    {
        return $model->newQuery()
            ->select('workspaces.id', 'workspaces.name', 'workspaces.created_at');
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
            ->setTableId('workspaces-table')
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
            new Column(['data' => 'name', 'name' => 'workspaces.name', 'title' => __('workspaces.name'), 'searchable' => false]),
            new Column(['data' => 'created_at', 'name' => 'workspaces.created_at', 'title' => __('workspaces.created_at'), 'searchable' => false]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Workspaces_' . date('YmdHis');
    }
}
