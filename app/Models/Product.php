<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
class Product extends Model
{

    protected $keyType = 'integer';

    protected $fillable = [
        'name', 'slug', 'description', 'available_quantity', 'image', 'is_active', 'price', 'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
