<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name'=>['required','min:4'],
            'email'=>['required','string','email','unique:suppliers,email'],
            'phone_number'=>['required','string','unique:suppliers,phone_number'],
            'address'=>['required','string'],
        ];
    }
}
