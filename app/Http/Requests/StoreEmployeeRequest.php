<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name'    => 'bail|required|min:3',
            'code'    => 'bail|required|unique:employees',
            'cpf'     => 'bail|required|max:14|unique:employees',
            // 'cpf'     => 'bail|required|cpf|max:14|unique:employees',
            'status'  => 'bail|required',
            'role_id' => 'bail|required',
            'department_id' => 'bail|required',
            'company_id'    => 'bail|required',
        ];
    }
}
