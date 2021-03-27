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
    {// { $user= Auth::user();
    //     $role = $user->getRoleNames()->first();  
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function($receptionist){
                return view('actions', compact('receptionist'));
            })
                 ->addColumn('actions', function($row){
                $ids=Receptionist::where('created_by',Auth::id())->pluck('id')->toArray();

                if (!Auth::user()->hasRole('admin') && !in_array($row->id,$ids)){
                    return;
                }
                if(Auth::user()->hasRole('admin')){
                    $btn = '<a href="'. route('admin.show-receptionist',[$row['id']]) .'" class="edit btn btn-info btn-sm ml-2">View</a>';
                   $btn = $btn.'<a href="'. route('admin.edit-receptionist',[$row['id']]) .'" class="edit btn btn-primary btn-sm ml-2">Edit</a>';
                   $btn = $btn.'<a href="'. route('admin.destroy-receptionist',[$row['id']]) .'" class="edit btn btn-danger btn-sm ml-2">Delete</a>';

                    return $btn;
                }
                   $btn = '<a href="'. route('mangerEditReceptionist',['user'=>$row['id']]) .'" class="edit btn btn-info btn-sm ml-2">Edit</a>';
                   $btn = $btn.'<a href="'. route('managerReceptionist',['receptionist'=>$row['id']]) .'" class="edit btn btn-danger btn-sm ml-2">Delete</a>';
                   $btn = $btn.'<a href="'. route('ban',['id'=>$row['id']]) .'" class="edit btn btn-warning btn-sm ml-2">Ban|Unban</a>'; 
                   return $btn;
            })
            ->editColumn('created_at', function ($receptionist) {
                return $receptionist->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $receptionist->created_at)->format('Y-m-d'): '';
            })

            ->editColumn('isban', function ($receptionist) {
                
                return $receptionist->isban ? 'Banned' : 'Not Banned';
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
            [
                'name' => 'isban',
                'data' => 'isban',
                'title' => 'Ban|Unban',
            ]
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
