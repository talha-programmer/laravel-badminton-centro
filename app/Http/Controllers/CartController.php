<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartServices;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('checkout');
    }

    public function addProduct(Request $request)
    {
        $productId = $request->product_id;
        $isPrivate = $request->has('private_cart');
        $product = Product::find($productId);
        if($product) {
            CartServices::addToCart($product, 1, $isPrivate);
            return response()->json(['info', 'Item successfully added in the cart']);
        }
        return response()->json(['error', 'Failed to add item in the cart']);

    }

    public function deleteProduct(Request $request)
    {
        $productId = $request->product_id;
        $isPrivate = $request->has('private_cart');
        if(CartServices::deleteProduct($productId, $isPrivate)) {
            return response()->json(['info', 'Item successfully deleted in the cart']);
        }
        return response()->json(['error', 'Failed to delete item from the cart']);

    }

    public function updateProduct(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $isPrivate = $request->has('private_cart');
        if(CartServices::updateProductQuantity($productId, $quantity, $isPrivate)) {
            return response()->json(['info', 'Item successfully updated!']);
        }
        return response()->json(['error', 'Failed to update the item!']);

    }

    public function checkout()
    {
        $user = auth()->user();
        if($cart = CartServices::getCart()){
            return view('public.checkout', [
                'cart' => $cart,
                'user' => $user,
            ]);
        }
        return back()->with('error', 'Cart is empty! Please add some products to cart first!');
    }

}
