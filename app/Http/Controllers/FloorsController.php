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
        // $floors = Floor::all();
        // dd($floors[0]->name);

        $floors= Floor::all();
        // dd($floors);
        // dd($floors[0]->name);
        return $floor->render('floors.index');
        // return view('posts.index', [
        //     'posts' => $posts,
        // ]);
        //return $room->render('manager.rooms', ['title' => 'Rooms', 'floors' => $floors]);
        
        
        // <a class="btn btn-primary" href="{{ route('floors.index', ['']) }}" >Update</a>
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
        // dd($id);
        // $floor = ['id' => 1, 'title' => 'Laravel', 'description' => 'Show Post Description', 'posted_by' => 'Ahmed', 'created_at' => '2021-03-13'];
        // dd($floor);

        //new commented
        $floor = Floor::find($id);
        // dd($floor);
        return view('floors.edit', [
            'floor'=> $floor,
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
    public function update($id, Request $myRequestObject)
    {
        // dd($myRequestObject->all());
        $data = $myRequestObject->all();
        // dd($data);
        Floor::find($id)->update($data);
        return redirect()->route('floors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Floor::destroy($id);
        return redirect()->route('floors.index');
    }
}