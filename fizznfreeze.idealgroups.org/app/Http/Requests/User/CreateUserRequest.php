<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
      'email' => 'required|email|unique:users,email',
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'phone_no' => 'nullable|string|max:20',
      'password' => 'required|string|min:8',
      'role' => 'required|exists:roles,id',
      'address_line_1' => 'nullable|string',
      'address_line_2' => 'nullable|string',
      'state_name' => 'nullable|string|max:255',
      'zip_code' => 'nullable|string|max:20',
    ];
  }
}
