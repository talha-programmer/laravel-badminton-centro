<?php


namespace App\Services;


use App\Models\Product;

class CartServices
{
    public static function addToCart(Product $product)
    {

        $cart = session()->get('cart');
        $products = $cart['products'];

        $productArray = [
            "id" =>$product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image_url" => $product->image_url
        ];

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = array();
            $cart['products'] = [
                $product->id => $productArray ,
            ];
            $products = $cart['products'];
        }
        else if(isset($products[$product->id])) {
            // cart is not empty and item added already

            $products[$product->id]['quantity']++;

        }else {
            // Item not added already
            $products[$product->id] = $productArray;
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

        $cart['products']  = $products;
        session()->put('cart', $cart);

    }

    public static function deleteProduct($productId)
    {
        $cart = session()->get('cart');
        $products = $cart['products'];
        if(isset($products[$productId])) {
            // Set the total quantity and total price
            $product = $products[$productId];
            $cart['total_quantity'] -= $product['quantity'];
            $cart['total_price'] -= $product['price'] * $product['quantity'];

            // remove the item
            unset($cart['products'][$productId]);

            session()->put('cart', $cart);
            return true;
        }
        return false;
    }

    public static function updateProductQuantity($productId, $quantity){
        $cart = session()->get('cart');
        $products = $cart['products'];
        if(isset($products[$productId])) {
            $product = $products[$productId];
            $product['quantity'] = $quantity;
            $products[$productId] = $product;

            $totalPrice = $totalQuantity = 0;
            foreach ($products as $product){
                $totalPrice += $product['price'] * $product['quantity'];
                $totalQuantity += $product['quantity'];
            }

            $cart['products'] = $products;
            $cart['total_price'] = $totalPrice;
            $cart['total_quantity'] = $totalQuantity;

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