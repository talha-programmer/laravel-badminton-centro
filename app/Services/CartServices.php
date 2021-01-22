<?php


namespace App\Services;


use App\Models\Product;

class CartServices
{
    public static function addToCart(Product $product)
    {

        $cart = session()->get('cart');

        $productArray = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image_url" => $product->image_url
        ];

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $product->id => $productArray ,
            ];
        }
        else if(isset($cart[$product->id])) {
            // cart is not empty and item added already

            $cart[$product->id]['quantity']++;

        }else {
            // Item not added already
            $cart[$product->id] = $productArray;
        }


        // Adding total quantity and total price
        if(isset($cart['total_quantity'] ) and isset($cart['total_price'])){
            $cart['total_quantity']++;
            $cart['total_price'] += $product->price;
        } else{
            // For first product
            $cart['total_quantity'] = 1;
            $cart['total_price'] = $product->price;
        }

        session()->put('cart', $cart);

    }

    public static function deleteProduct($product_id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            return true;
        }
        return false;
    }

    public static function deleteCart()
    {
        if(session()->has('cart')) {
            session()->remove('cart');
        }
    }

    public static function getCart()
    {
        if(session()->has('cart')) {
            return session()->get('cart');
        }
        return null;
    }
}