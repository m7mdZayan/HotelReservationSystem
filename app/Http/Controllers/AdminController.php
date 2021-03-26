<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ManagerDatatable;
use App\DataTables\ReceptionistsDatatable;
use App\DataTables\ClientsDatatable;
use App\Models\Manager;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/index');
    }

    public function manage_managers(ManagerDatatable $manager)
    {
        
        return $manager->render('manager.rooms');

    }

    public function manage_receptionists(ReceptionistsDatatable $receptionist)
    {
        return $receptionist->render('manager.rooms');
    }

    public function manage_client(ClientsDatatable $clients)
    {
        return $clients->render('manager.rooms');
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
    public function show($user)
    {
        $user = User::find($user);
        return view('admin.show', [
            'user' => $user
        ]);
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
        $user = User::find($id);
        return view('admin.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $user->update($request->all());
        return redirect()->route('admin.managers');
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
        User::where('id', $id)->delete();
        return redirect()->route('admin.managers');
    }


    public function show_receptionist($user)
    {
        $user = User::find($user);
        return view('admin.receptionist.show', [
            'user' => $user
        ]);
    }

    public function edit_receptionist($id)
    {
        //
        $user = User::find($id);
        return view('admin.receptionist.edit', [
            'user' => $user
        ]);
    }
    
    public function update_receptionist(Request $request, User $user)
    {
        //
        $user->update($request->all());
        return redirect()->route('admin.receptionists');
    }

    public function destroy_receptionist($id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->route('admin.receptionists');
    }
    
    public function show_customer($user)
    {
        $user = User::find($user);
        return view('admin.customer.show', [
            'user' => $user
        ]);
    }

    public function edit_customer($id)
    {
        //
        $user = User::find($id);
        return view('admin.customer.edit', [
            'user' => $user
        ]);
    }
    
    public function update_customer(Request $request, User $user)
    {
        //
        $user->update($request->all());
        return redirect()->route('admin.client');
    }

    public function destroy_customer($id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->route('admin.client');
    }
}
