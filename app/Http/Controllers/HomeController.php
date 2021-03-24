<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserDataTable $dataTable, Request $request)
    {
        // if ($request->ajax()) {
        //     $data = User::select('*');
        //     return Datatables::of($data)
        //             ->addIndexColumn()

        //             ->addColumn('action', function($row){

        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm ml-2">View</a>';
        //                    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm ml-2">Edit</a>';
        //                    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm ml-2">Delete</a>';

        //                     return $btn;
        //             })

        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        // return $dataTable->render('user');
        return view('home');
    }
}
