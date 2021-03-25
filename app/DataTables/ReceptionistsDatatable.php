<?php

namespace App\DataTables;

use App\Models\Receptionist;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ReceptionistsDatatable extends DataTable
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
            ->addColumn('actions', 'actions')
            ->editColumn('created_at', function ($receptionist) {
                return $receptionist->created_at ? with(new Carbon($receptionist->created_at))->diffForHumans() : '';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Receptionist $model): \Illuminate\Database\Eloquent\Builder
    {
        // $user= Auth::user();
        // dd($user);
        // $users = User::role('manager')->get();
        // $user->hasRole('manager')
        // if($users){
        return User::role('receptionist')->newQuery();
            // ->with('manager')
            // ->select('users.*')->where('created_by',Auth::id() );
        // }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('receptionistsDatatable')
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
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Created at'
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
        return 'Receptionists_' . date('YmdHis');
    }
}