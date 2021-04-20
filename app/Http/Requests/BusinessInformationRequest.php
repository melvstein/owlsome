<?php

namespace App\Http\Requests;

use App\Models\BusinessInformation;
use Illuminate\Foundation\Http\FormRequest;

class BusinessInformationRequest extends FormRequest
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
        $businessInformation = BusinessInformation::findOrFail(1);
        return [
            'name' => 'required|string|max:255',
            'contactNumber' => 'required|string|min:11|max:11|unique:business_informations,contactNumber,'.$businessInformation->id,
            'email' => 'required|string|email|max:255|unique:business_informations,email,'.$businessInformation->id,
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'display' => 'required|string|max:255',
            'google_map_src' => 'required|string',
        ];
    }
}
