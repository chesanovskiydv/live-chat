<?php

namespace App\DataTables;

use App\Models\Visitor;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VisitorsDataTable extends DataTable
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
            ->editColumn('email', function (Visitor $visitor) {
                return \Html::mailto($visitor->email);
            })->setRowAttr([
                'data-key' => function (Visitor $visitor) {
                    return $visitor->getKey();
                },
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Visitor $visitor
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(Visitor $visitor)
    {
        return $visitor->newQuery();
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
            ->setTableId('visitors-table')
            ->columns($columns)
            ->minifiedAjax()
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
            new Column(['data' => 'name', 'name' => 'visitors.name', 'title' => __('visitors.name')]),
            new Column(['data' => 'email', 'name' => 'visitors.email', 'title' => __('visitors.email')]),
            new Column(['data' => 'created_at', 'name' => 'visitors.created_at', 'title' => __('visitors.created_at'), 'searchable' => false]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Visitors_' . date('YmdHis');
    }
}
