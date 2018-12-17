<?php

namespace App\Http\Requests\Backend\Menu;

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
            'menu_name' => 'required|string',
            'menu_no' => 'required|string',
            'number' => 'required|integer',
            'spicy' => 'required|integer',
            'status' => 'required|string',
            'price' => 'required|string',
            'menu_category_id' => 'required|integer',
            'is_recommend' => 'required|string',
            'is_hot' => 'required|string',
            'introduction' => 'string',
            'order' => 'integer',
        ];
    }
}
