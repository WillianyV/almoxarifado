<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseRequest extends FormRequest
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
            'description' => "bail|required|min:3|max:100|unique:warehouses",
            'status'      => 'bail|required',
            'address'     => 'bail|required|min:3|max:150',
            'district'    => 'bail|required|min:2|max:150',
            'number'      => 'bail|required|string',
            'city'        => 'bail|required|min:3|max:150',
            'state'       => 'bail|required|max:2',
            'zipcode'     => 'bail|required|max:9',
        ];
    }
}
