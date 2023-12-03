<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->long_description,
            'available_quantity' => $this->available_quantity,
            'original_price' => $this->formatCurrency($this->original_price),
            'purchase_price' => $this->formatCurrency($this->purchase_price),
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }

    /**
     * Format currency.
     *
     * @param  float  $amount
     * @return string
     */
    private function formatCurrency($amount)
    {
        return number_format($amount, 2) . " EGP";
    }
}
