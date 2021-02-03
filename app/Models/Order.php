<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
