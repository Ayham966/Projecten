<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id', 'image', 'price', 'quantity'];

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function checkout()
    {
        return $this->hasMany(Checkout::class , 'product_id');
    }

}
