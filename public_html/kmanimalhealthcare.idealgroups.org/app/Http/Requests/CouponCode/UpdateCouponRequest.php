<?php

namespace App\Http\Requests\CouponCode;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Determine if the company is authorized to make this request.
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
            'coupon_title' => 'required',
            'coupon_code' => 'required',
            'coupon_type' => 'required',
            'coupon_amount' => 'required',
            'minimum_order' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'product' => 'required',
            'per_user_use' => 'required'
        ];
    }
}
