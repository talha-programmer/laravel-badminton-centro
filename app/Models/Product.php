<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'products_with_categories');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders')->withPivot('quantity');
    }

}
