<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product;

class CartServices
{
    private static  $deliveryCharges = 100;

    // This key '$cartKey' is used to store cart inside session 
    // In case of private cart, the key would be different
    // Private cart would not be displayed on public pages. 
    // Instead, it handles the 'Update Order' functions of the OrderController
    private static function getCartKey(bool $privateCart){
        if($privateCart){
            $cartKey = 'cart_private';
        } else {
            $cartKey = 'cart';
        }
        return $cartKey;
    }
    
    public static function addToCart(Product $product, int $productQuantity = 1, bool $privateCart = false)
    {
        $cartKey = self::getCartKey($privateCart);  
        $cart = session()->get($cartKey);
        $products = $cart['products'];

        $productArray = [
            "id" =>$product->id,
            "name" => $product->name,
            "quantity" => $productQuantity,
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

            $products[$product->id]['quantity']+= $productQuantity;

        }else {
            // Item not added already
            $products[$product->id] = $productArray;
        }


        // Adding total quantity and total price
        if(isset($cart['total_quantity'] ) and isset($cart['total_price'])){
            $cart['total_quantity']+= $productQuantity;
            $cart['total_price'] += $product->price * $productQuantity;
        } else{
            // For first product
            $cart['total_quantity'] = $productQuantity;
            $cart['total_price'] = $product->price * $productQuantity;
        }

        $cart['delivery_charges'] = CartServices::$deliveryCharges * $cart['total_quantity'];
        $cart['grand_total'] = $cart['delivery_charges'] + $cart['total_price'];
        $cart['products']  = $products;

        session()->put($cartKey, $cart);

    }

    public static function deleteProduct($productId, bool $privateCart = false)
    {
        $cartKey = self::getCartKey($privateCart);

        $cart = session()->get($cartKey);
        $products = $cart['products'];
        if(isset($products[$productId])) {
            // Set the total quantity and total price
            $product = $products[$productId];
            $cart['total_quantity'] -= $product['quantity'];
            $cart['total_price'] -= $product['price'] * $product['quantity'];

            // remove the item
            unset($cart['products'][$productId]);

            $cart['delivery_charges'] = CartServices::$deliveryCharges * $cart['total_quantity'];
            $cart['grand_total'] = $cart['delivery_charges'] + $cart['total_price'];

            session()->put($cartKey, $cart);
            return true;
        }
        return false;
    }

    public static function updateProductQuantity($productId, $quantity, bool $privateCart = false){
        $cartKey = self::getCartKey($privateCart);
        $cart = session()->get($cartKey);
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

            $cart['delivery_charges'] = CartServices::$deliveryCharges * $cart['total_quantity'];
            $cart['grand_total'] = $cart['delivery_charges'] + $cart['total_price'];

            session()->put($cartKey, $cart);
            return true;
        }
        return false;
    }

    public static function deleteCart(bool $privateCart = false)
    {
        $cartKey = self::getCartKey($privateCart);
        if(session()->has($cartKey)) {
            session()->remove($cartKey);
        }
    }

    public static function getCart(bool $privateCart = false)
    {
        $cartKey = self::getCartKey($privateCart);
        if(session()->has($cartKey)) {
            return session()->get($cartKey);
        }
        return null;
    }


    /**
     * Create private cart from the Order. All products will be added to cart for
     * any modifications required
     * @param Order $order
     */
    public static function createPrivateCart(Order $order)
    {
        session()->remove('cart_private');
        foreach ($order->products as $product){
            $quantity = $product->pivot->quantity;
            self::addToCart($product, $quantity, true);
        }
    }
}