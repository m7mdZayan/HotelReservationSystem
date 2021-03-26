<?php

namespace App\DataTables;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use App\Models\User;


class ReservationsDatatable extends DataTable
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
            ->addColumn('actions', 'actions')
            ->editColumn('created_at', function ($reservation) {
                return $reservation->created_at ? with(new Carbon($reservation->created_at))->diffForHumans() : '';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReservationsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model)
    {
        if (Auth::user()->hasRole('user')) {
            return $model->newQuery()
            ->with('client')
            ->select('reservations.*')->where('client_id', Auth::id());
        }
        else if(Auth::user()->hasRole('receptionist')){
            return $model->newQuery()
            ->with('client')
            ->select('reservations.*');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('reservationsDatatable')
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
                'name' => 'accompany_number',
                'data' => 'accompany_number',
                'title' => 'Accompany No.'
            ],
            [
                'name' => 'room_id',
                'data' => 'room_id',
                'title' => 'Room Id'
            ],
            [
                'name' => 'paid_price',
                'data' => 'paid_price',
                'title' => 'Paid price'
            ],
            [
                'name' => 'client_id',
                'data' => 'client.name',
                'title' => 'Name'
            ],
            // [
            //     'name' => 'actions',
            //     'data' => 'actions',
            //     'title' => 'Actions',
            //     'printable' => false,
            //     'exportable' => false,
            //     'searchable' => false,
            //     'orderable' => false,
            // ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reservations_' . date('YmdHis');
    }
}
