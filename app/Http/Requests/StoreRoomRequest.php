<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        return [
            'number' => 'required|min:4|unique:rooms',
            'capacity' => 'required|min:1|max:6',
            'price' => 'required|numeric',
            'floor_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'price is required',
            'price.numeric'  => 'price should be number',
            'capacity.required' => 'capacity is required',
            'capacity.min'=>'the minimum capacity is 1',
            'capacity.max'=>'the maximum capacity is 6',
            'floor_id.required'=>'floor is required',
            'floor_id.numeric'=>'please enter the floor number',
            'number.required'=>'number is required',
            'number.min'=>'the minimum room number is 4 digits',
            'number.unique'=>'the room number should be unique',
        ];
    }

}
