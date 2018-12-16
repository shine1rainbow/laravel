<?php

namespace App\Http\Requests\Backend\MenuType;

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
            'name' => 'required|string',
            'shop_id' => 'required|integer',
            'is_recommend' => 'required|string',
            'is_hot' => 'required|string',
            'opening_time' => 'required|string',
            'serving_time' => 'required|string',
            'working_date' => 'required|string',
        ];
    }
}
