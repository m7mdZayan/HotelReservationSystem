<?php

namespace App\DataTables;

use App\Models\Floor;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class FloorsDatatableCopy extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', 'floors.actions') //name , view file
            ->addColumn('new', 'new')
            ->editColumn('created_at', function ($room) {
                return $room->created_at ? with(new Carbon($room->created_at))->diffForHumans() : '';
            })
            ->rawColumns(['actions','new']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Floor $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()
            ->with('manager')
            ->select('floors.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('FloorsDatatableCopy')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->lengthMenu([[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [

            // [
            //     'name' => 'id',
            //     'data' => 'id',
            //     'title' => 'Floor_id'
            // ],
            [
                'name' => 'number',
                'data' => 'number',
                'title' => 'Floor_number'
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],
            [
                'name' => 'created_by',
                'data' => 'manager.name',
                'title' => 'Created by'
            ],
            // [
            //     'name' => 'created_at',
            //     'data' => 'created_at',
            //     'title' => 'Created at'
            // ],
            // [
            //     'name' => 'new',
            //     'data' => 'new',
            //     'title' => 'new'
            // ],
            [
                'name' => 'actions',
                'data' => 'actions',
                'title' => 'Actions',
                'printable' => false,
                'exportable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Floors_' . date('YmdHis');
    }
}



