<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;


class ReservedRoomsDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function($room){
                return '<a class="btn btn-primary" href="' . route('client.reservation_form',['client' => Auth::id(), 'room' => $room['id']]) .'">Reserve</a>';
            })
            ->editColumn('status', function ($room) {
                return $room->status ? '<span class="badge badge-primary">Available</span>'
                    : '<span class="badge badge-warning">Reserved</span>';
            })
            ->rawColumns(['actions'])
            ->escapeColumns('status');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReservedRoomsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()
            ->with('manager')
            ->select('rooms.*')->where('status','1');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('reservedRoomsDatatable')
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
    protected function getColumns()
    {
        return [

            [
                'name' => 'number',
                'data' => 'number',
                'title' => 'Room_number'
            ],
            [
                'name' => 'capacity',
                'data' => 'capacity',
                'title' => 'Capacity'
            ],
            [
                'name' => 'price',
                'data' => 'price',
                'title' => 'Price'
            ],
            [
                'name' => 'floor_id',
                'data' => 'floor_id',
                'title' => 'Floor_id'
            ],
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
    protected function filename()
    {
        return 'ReservedRooms_' . date('YmdHis');
    }
}
