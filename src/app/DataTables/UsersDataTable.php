<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('action', function (User $user) {
                return \Html::actions([
                    'update' => ['url' => route('admin::users.edit', ['user' => $user]), 'can' => ['update', $user]],
                    'delete' => [
                        'url' => route('admin::users.destroy', ['user' => $user]), 'method' => 'DELETE',
                        'can' => ['delete', $user],
                        'confirmation' => [
                            'title' => __('form.confirmation.delete.title'),
                            'text' => __('form.confirmation.delete.text'),
                        ]
                    ],
                ]);
            })->editColumn('email', function (User $user) {
                return \Html::mailto($user->email);
            })->setRowAttr([
                'data-key' => function (User $user) {
                    return $user->getKey();
                },
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $user)
    {
        return $user->newQuery()->select('id', 'name', 'email');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => __('grid.action_column'), 'class' => 'actions'])
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
            new Column(['data' => 'DT_RowIndex', 'name' => 'created_at', 'title' => __('grid.key_column'), 'class' => 'key']),
            new Column(['data' => 'name', 'name' => 'name', 'title' => __('user.name')]),
            new Column(['data' => 'email', 'name' => 'email', 'title' => __('user.email')]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
