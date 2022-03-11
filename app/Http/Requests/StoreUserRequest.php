<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'     => 'bail|required|min:3',
            'cpf'      => 'bail|required|max:14',
            'password' => 'bail|required|min:8|max:20',
            'type'     => 'bail|required',
            'status'   => 'bail|required',
            'warehouse_id' => 'bail|required'
        ];
    }
}
