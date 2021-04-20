<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OncartCheckoutRequest extends FormRequest
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
            'receiverName' => 'required|string|max:255',
            'receiverNumber' => 'required|string|min:11|max:11',
            'city' => 'required|string|max:255',
            'shippingAddress' => 'required|string|max:255',
        ];
    }
}
