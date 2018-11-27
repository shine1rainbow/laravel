<?php

namespace App\Http\Requests\Backend\Shop;

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
            'restaurant_name' => 'required|string',
            'restaurant_logo' => 'required|string',
            'restaurant_background' => 'required|string',
            'food_type' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'string',
            'landline' => 'string',
            'address' => 'string',
            'postcode' => 'string',
            'service_charge' => 'string',
            'payment_sequence' => 'string',
            'vat_reg_no' => 'string',
            'images' => 'string',
            'introduction' => 'string',
            'remind' => 'string',
            'activity' => 'string',
            'business_hour' => 'string',
        ];
    }
}
