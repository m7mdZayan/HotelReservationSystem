<?php

namespace App\Http\Controllers;

use App\DataTables\RoomsDatatable;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $floors = Floor::all();
        return $room->render('manager.rooms', ['title' => 'Rooms', 'floors' => $floors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'price' => 'required|numeric',
            'capacity' => 'required|min:1|max:6',
            'floor' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        Room::create([
            'capacity'  => $request->capacity,
            'price'     => $request->price,
            'floor_id'  => $request->floor,
            'created_by'=> auth()->user()->id
        ]);

        return \response()->json(array('success' => true), 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Room $room)
    {
        if (\request()->ajax()) {
            if ($room->delete()) {
                return \response('success');
            }
        }

    }
}