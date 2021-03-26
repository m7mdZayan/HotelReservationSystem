<?php

namespace App\DataTables;

use App\Models\Client;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientsDatatable extends DataTable
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
            // ->addColumn('actions', 'actions')
            // ->addColumn('actions', 'actions')
                 ->addColumn('actions', function($row){
                $ids=Client::where('created_by',Auth::id())->pluck('id')->toArray();

                if (!Auth::user()->hasRole('admin') && !in_array($row->id,$ids)){
                    return;
                }
                   $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm ml-2">View</a>';
                   $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm ml-2">Edit</a>';
                   $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm ml-2">Delete</a>';

                    return $btn;
            })
            ->editColumn('created_at', function ($client) {
                return $client->created_at ? with(new Carbon($client->created_at))->diffForHumans() : '';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model): \Illuminate\Database\Eloquent\Builder
    {
        return User::role('user')->newQuery();
            // ->with('manager')
            // ->select('users.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('clientsDatatable')
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

            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],
            [
                'name' => 'email',
                'data' => 'email',
                'title' => 'Email'
            ],
            [
                'name' => 'mobile',
                'data' => 'mobile',
                'title' => 'Mobile'
            ],
            [
                'name' => 'country',
                'data' => 'country',
                'title' => 'Country'
            ],
            [
                'name' => 'gender',
                'data' => 'gender',
                'title' => 'Gender'
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
    protected function filename(): string
    {
        return 'Clients_' . date('YmdHis');
    }
}
