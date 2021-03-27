<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Floor;
use App\DataTables\ClientsDatatable;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\ReceptionistsDatatable;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 



class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.index');
    }

    public function manage_receptionists(ReceptionistsDatatable $receptionist)
    {
        return $receptionist->render('manager.rooms');

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
    //     // dd(request());
    //     // dd(Floor::find(1)); //correct
        // $floor = Floor::find(1)->manager->name; //correct
    //     return view('manager.floors');
    // }

    public function show()
        {
                    //$floor = Floor::find(1)->manager->name; //correct
                    // dd($floor);
                     // dd(Floor::find(1)); //correct
        
            //return $dataTable->render('manager.floors');
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
         return view('receptionist.edit',compact('user'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user){
        $user=User::findOrFail($user);
        //dd((int)$request['mobile']);
        //$user->update($request->all());
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'country' => $request['country'],
        ]);
        return redirect()->route('manager.receptionists') ->with('success','Data updated successfully');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('manager.receptionists'); 
    }

    public function ban($id)
    {
        $user= User::where('id', $id)->first();
        //dd($user->isban);
        if($user->isban == 1)
        {
            User::where('id', $id)->update(array('isban' => '0'));    
        }
        else
        {
            User::where('id', $id)->update(array('isban' => '1'));
        }
        //User::where('id', $id)->update(array('isban' => '1'));
        return redirect()->route('manager.receptionists');
    }
}
