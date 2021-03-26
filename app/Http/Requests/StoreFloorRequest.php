<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StoreFloorRequest extends FormRequest
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
            'name'=>['Required', 'min:3', 'unique:floors'],
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'name.min' => 'min length of name is 3 characters',
            'name.unique'=>'floor already used',
        ];
    }
}
