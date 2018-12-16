<?php

namespace App\Http\Requests\Backend\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id' => 'required|integer',
            'shop_id' => 'string',
            'nickname' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'position' => 'string',
            'age' => 'string',
            'phone' => 'string',
            'gender' => 'string',
        ];
    }
}
