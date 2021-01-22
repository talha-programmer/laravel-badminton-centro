<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartServices;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::find($productId);
        if($product) {
            CartServices::addToCart($product);
            return response()->json(['info', 'Item successfully added in the cart']);
        }
        return response()->json(['error', 'Failed to add item in the cart']);

    }


}
