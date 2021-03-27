<?php

namespace App\Http\Controllers;

use App\DataTables\RoomsDatatable;
use App\Http\Requests\EditRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoomsDatatable $room
     * @return Response
     */
    public function index(RoomsDatatable $room)
    {
        return $room->render('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRoomRequest $myRequestObject)
    {

        $data = $myRequestObject->all();
        $data['status'] = 1;
        $data['created_by'] = Auth::user()->id ;
        $floor_number = $data['floor_id'];
        if(!Floor::where('number', $floor_number)->get()->isEmpty())
        {
            $data['floor_id'] = Floor::where('number', $floor_number)->get()[0]->id;
            Room::create($data);
        }else 
        {
            return Redirect::back()->withErrors("this floor does not exist");
        }
        
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        // dd($floor);
        return view('rooms.edit', [
            'room'=> $room,
            // 'users'=> User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(EditRoomRequest $myRequestObject, $id)
    {
        $data = $myRequestObject->all();
        // dd($data);
        Room::find($id)->update($data);
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if(!Room::find($id)->status == 0)
        {
            Room::destroy($id);
            return redirect()->route('rooms.index');
        }
        else
        {
            return Redirect::back()->withErrors("can not delete a reserved room");
        }
    }
}