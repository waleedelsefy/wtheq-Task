<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'available_quantity' => 'required|numeric',
            'original_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
        ];
    }
}
