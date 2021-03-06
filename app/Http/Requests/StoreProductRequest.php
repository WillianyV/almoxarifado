<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'code'         => 'bail|required',
            'image'        => 'bail|nullable|image|mimes:jpeg,png,jpg|max:4096',
            'description'  => 'bail|required',
            'stock'        => 'bail|required',
            'minimumStock' => 'bail|required',
            'status'       => 'bail|required',
            'category_id'  => 'bail|required',
            'provider_id'  => 'bail|required',
            'warehouse_id' => 'bail|required',
            'unitaryValue' => 'bail|required',
        ];
    }
}
