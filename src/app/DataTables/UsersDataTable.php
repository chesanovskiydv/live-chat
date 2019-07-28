<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Query\JoinClause;
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
            ->addColumns(['workspace_display_name', 'created_at'])
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(User $user)
    {
        $roleUser = config('laratrust.tables.role_user');

        return $user->newQuery()
            ->select(
                'users.id', 'users.name', 'users.email', 'users.created_at',
                'workspaces.id as workspace_id', 'workspaces.display_name as workspace_display_name'
            )
            ->leftJoin($roleUser, function (JoinClause $query) use ($roleUser, $user) {
                $query->on("{$roleUser}.user_id", "users.id")
                    ->where("{$roleUser}.user_type", $user->getMorphClass());
            })
            ->leftJoin('workspaces', "{$roleUser}.workspace_id", 'workspaces.id');
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
            ->setTableId('users-table')
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
            new Column(['data' => 'name', 'name' => 'users.name', 'title' => __('users.name')]),
            new Column(['data' => 'email', 'name' => 'users.email', 'title' => __('users.email')]),
            new Column(['data' => 'workspace_display_name', 'name' => 'workspaces.display_name', 'title' => trans_choice('workspaces.workspace', 1)]),
            new Column(['data' => 'created_at', 'name' => 'users.created_at', 'title' => __('users.created_at'), 'searchable' => false]),
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
