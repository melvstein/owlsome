<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileInfoRequest extends FormRequest
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
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'contactNumber' => 'required|string|min:11|max:11|unique:users,contactNumber,'.auth()->user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
    }
}
