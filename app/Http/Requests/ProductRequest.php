<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>['required','string','max:60','min:5','unique:products,name'],
            'barcode'=>['sometimes'],
            'supplier_id'=>['required'],
            'price'=>['required'],
            'stock'=>['required'],
            'expire_at'=>['required'],
            'is_dept'=>['required'],
        ];
    }
}
