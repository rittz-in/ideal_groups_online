<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateFrontUserRegistration extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|string|unique:users,email,NULL,id,deleted_at,NULL',
            'address1' => 'required',
            'address2' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',



        ];

    }
}
