<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\ClientsDatatable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\ReservationsDatatable;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('receptionist.index');
    }

    public function manage_client(ClientsDatatable $users)
    {
        return $users->render('manager.rooms');

    }

    public function approve_clients(ClientsDatatable $users)
    {
        //$users = DB::table('users')->get();
        return $users->render('manager.rooms');
        //return view('receptionist.approve',['users' =>$users]);
    }

    public function status(Request $request , $id){
        $data = User::find($id);
         if($data->status == 0)
        {
            #code.
            $data->status = 1;
        }


        $data->save();
        return Redirect::back()->with('message', $data->name.'Status has been changed successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show()
    // {

    // }
    public function show(ReservationsDatatable $client)
    {
        return $client->render('receptionist.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
