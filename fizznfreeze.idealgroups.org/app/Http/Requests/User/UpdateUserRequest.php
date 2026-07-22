<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    $decryptedId = decrypt($this->route('encrypted_id'));
    return [
      'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($decryptedId)],
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'phone_no' => 'nullable|string|max:20',
      'password' => 'nullable|string|min:8',
      'role' => 'required|exists:roles,id',
      'address_line_1' => 'nullable|string',
      'address_line_2' => 'nullable|string',
      'state_name' => 'nullable|string|max:255',
      'zip_code' => 'nullable|string|max:20',
    ];
  }
}
