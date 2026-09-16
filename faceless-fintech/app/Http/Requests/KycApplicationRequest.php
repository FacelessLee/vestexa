<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KycApplicationRequest extends FormRequest
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
           
            
            
            'dob' => 'required',
            'age'=>'required|max:8',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'document_type' => 'required',
            'frontimg' => 'required',
            'backimg' => 'required',
        ];
    }
}
