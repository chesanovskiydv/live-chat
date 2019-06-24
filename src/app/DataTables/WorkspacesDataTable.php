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
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Workspace $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workspace $model)
    {
        return $model->newQuery()->select('name');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            new Column(['data' => 'DT_RowIndex', 'name' => 'created_at', 'title' => __('grid.key_column'), 'width' => '50px']),
            new Column(['data' => 'name', 'name' => 'name', 'title' => __('workspace.name')]),
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
