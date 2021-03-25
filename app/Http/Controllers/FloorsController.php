<?php

namespace App\Http\Controllers;

use App\DataTables\FloorsDatatable;
use App\Http\Requests\StoreFloorRequest;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoomsDatatable $room
     * @return Response
     */
    public function index(FloorsDatatable $floor)
    {
        // dd($floor);
        //$floors = Floor::all();
        return $floor->render('manager.floors');
        //return $room->render('manager.rooms', ['title' => 'Rooms', 'floors' => $floors]);
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
    public function destroy(Floor $floor)
    {
        

    }
}