<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ClientsDatatable;
use App\DataTables\ReservationsDatatable;
use App\DataTables\ReservedRoomsDatatables;
use App\Models\Room;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        // $users = User::all();
        // //$id = User::find(1)->id;

        // return view('client.index', [
        //     'users' => $users,
        //     //'id' => $id
        // ]);  
        //return view('client.index');
    }

    public function my_reservation(ReservationsDatatable $client)
    {
         return $client->render('client.my_reservation');
        //eturn view('client.my_reservation');
    }

    public function make_reservation(ReservedRoomsDatatables $client){
        //$room = Room::
        return $client->render('client.make_reservation');
    }

    public function reservation_form(Request $request){
        // $data = $request->all();
        // dd($data);
        return view('client.reservation_form');
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
    public function store(ReservationRequest $request)
    {
        $room=Room::where('id',$request->room_id)->first();
        //dd($room);
        

        // Room::where('id',$request->id)->update(['status' => 1]);
        \Stripe\Stripe::setApiKey('sk_test_51IXkSpCm8y7Wcgvv5kmlxqoiqikN7kpMSo2UR5OboxcHAybFzuzrzsyx00Ooy64t23XzoLU2traWzYc20jPr1R2b00n6gtQhBq');
        		
		$amount = $room->price;
	    $amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'usd',
			'description' => 'Payment From Codehunger',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

        Reservation::create([
            'client_id' => Auth::user()->id,
            'room_id' => $request->room_id,
            'accompany_number' => $request->accompany_number,
            'paid_price' => $room->price,
        ]);

        //$status=Room::findOrFail($room);
        //dd($room);
        $room->update([
            'status' => '0',
        ]);

		return view('checkout.credit-card',compact('intent'));

        //return redirect('payment/');
    }

    public function payment(){
        return view('myProfile');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
