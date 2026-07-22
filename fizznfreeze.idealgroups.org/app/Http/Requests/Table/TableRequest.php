<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'table_number' => 'required',
            'name' => 'required',
            // 'status' => 'required' // checkbox handling usually done in controller or separate check
        ];
    }
}
