<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
class Product extends Model
{

    protected $keyType = 'integer';

    protected $fillable = [
        'name', 'short_description', 'long_description', 'available_quantity', 'original_price', 'purchase_price', 'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
