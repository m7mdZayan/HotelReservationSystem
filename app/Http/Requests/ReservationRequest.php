<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Room;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $room=Room::where('id',request()->room_id)->first();
        $capacity=$room->capacity;
        $price=(String)$room->price;
        
        return [
            'price' => 'required|integer|in:'.$price,
            'accompany_number' => ['required','integer',"max:$capacity"],
        ];
        
    }

    public function messages()
    {
        $room=Room::where('id',request()->room_id)->first();
        $capacity=$room->capacity;
        $price=$room->price;
        return [
            'price.in' => "Price should be $price for this room",
            'accompany_number.max' => "Accompany number should be equal or less than $capacity for this room",
        ];
    }
}
