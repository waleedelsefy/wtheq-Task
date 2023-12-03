<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'slug' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $originalSlug = Str::slug($this->input('name'), '-');
        $slug = $originalSlug;
        $counter = 1;

        // Check if the original slug already exists
        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $this->merge([
            'slug' => $slug,
        ]);
    }

    // Function to check if the slug already exists
    protected function slugExists($slug)
    {

        return \App\Models\Product::where('slug', $slug)->exists();
    }
}
