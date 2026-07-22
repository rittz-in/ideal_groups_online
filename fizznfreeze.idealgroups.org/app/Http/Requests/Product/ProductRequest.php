<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric|lt:price',
        ];

        // If it's an update (PUT/PATCH) or if we can detect it's not a fresh creation
        // Assuming 'store' uses POST and 'update' uses PUT/PATCH, or strictly checking Route name could work too.
        // But checking for 'product_image' presence in update might be tricky if not sent.
        // Safer check: If the request route is for update, it's nullable.
        
        if ($this->isMethod('post')) {
            $rules['product_image'] = 'required';
        } else {
             $rules['product_image'] = 'nullable';
        }

        return $rules;
    }
}
