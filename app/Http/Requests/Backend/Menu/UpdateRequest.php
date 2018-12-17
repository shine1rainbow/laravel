<?php

namespace App\Http\Requests\Backend\Menu;

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
            'menu_name' => 'required|string',
            'menu_no' => 'required|string',
            'number' => 'required|integer',
            'spicy' => 'required|integer',
            'status' => 'required|integer',
            'price' => 'required',
            'menu_category_id' => 'required|integer',
            'is_recommend' => 'required|integer',
            'is_hot' => 'required|integer',
            'introduction' => 'string',
            'order' => 'integer',
        ];
    }
}
