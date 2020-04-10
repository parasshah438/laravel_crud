<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:students',
                    'mobile' => 'required|numeric',
                    'image' => 'required|image|mimes:jpeg,jpg,png,gif',
                    'password' => 'required|min:6',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required',
                    'email' => 'required|unique:students,email,'.$this->student->id,
                    'mobile' => 'required|numeric',
                    'image' => 'image|mimes:jpeg,jpg,png,gif',
                ];
            }
            default:
            break;
        }
    }
}
