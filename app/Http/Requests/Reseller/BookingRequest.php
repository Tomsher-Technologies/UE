<?php

namespace App\Http\Requests\Reseller;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'shipper_name' => ['required', 'min:3', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'shipper_name.required' => "Please enter shipper name",
            'shipper_name.min' => "Name cannot be less than 3 characters",
            'shipper_name.max' => "Name cannot be less more 20 characters",
        ];
    }
}
