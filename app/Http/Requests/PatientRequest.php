<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Eloquent\User;

class PatientRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($this->isMethod('PUT')) {
            $arr = [
                'name' => 'required|max:255' ,
                'email' => 'max:255|unique:users,email,'.$request->id ,
                'address' => 'required|string|max:255',
                'age' => 'required|numeric',
                'phone' => 'string|max:20|min:9',
                'sex' => 'required|numeric',
            ];
            
            return $arr;
        }
        return [
            'name' => 'required|max:255' ,
            'email' => 'max:255|unique:users' ,
            'address' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone' => 'string|max:20|min:9',
            'sex' => 'required|numeric',
        ];
    }
}
