<?php

namespace App\Http\Requests\Backend\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'shop_id' => 'required|integer',
            'nickname' => 'string',
            'actions' => 'string',
            'avater' => 'string|nullable',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'position' => 'required|string',
            'phone' => 'required|string',
            'age' => 'string',
            'gender' => 'string',
        ];
    }
}
