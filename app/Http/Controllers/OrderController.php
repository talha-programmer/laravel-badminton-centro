<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserTypes;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userType = UserTypes::fromValue($user->user_type);
        if($userType->is(UserTypes::Admin)){
            $orders = Order::all();
        }else{
            $orders = $user->orders;
        }

        return view('order.index',[
            'orders'=>$orders,
        ]);

    }


    public function store(Request $request)
    {
        $cart = CartServices::getCart();

        $address = $request->address;
        $user = auth()->user();
        $user->address = $address;
        $user->save();

        $order = new Order();
        $order->user()->associate($user);
        $order->status = OrderStatus::Pending;
        $order->total_amount = $cart['grand_total'];
        $order->save();

        $products = $cart['products'];
        foreach ($products as $product){
            $productId = $product['id'];
            $quantity = $product['quantity'];
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }

        CartServices::deleteCart();
        return redirect()->route('dashboard');
    }

    public function editOrder(Order $order)
    {
        CartServices::createPrivateCart($order);

        return redirect()->route('display_edit_order', $order);
    }

    /**
     * Used different routes for creating private cart and displaying the Order
     * edit form because the products cannot be updated on private cart through
     * sessions in case of a single route
     * */
    public function displayEditOrder(Order $order)
    {
        $allProducts = Product::all();
        return view('order.edit_order', [
            'order' => $order,
            'all_products' => $allProducts,
        ]);
    }

    public function updateOrder(Request $request, Order $order)
    {
        $privateCart = CartServices::getCart(true);

        // Remove all products of the order before update
        $order->products()->detach();

        $products = $privateCart['products'];
        foreach ($products as $product){
            $productId = $product['id'];
            $quantity = $product['quantity'];
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }

        $order->status = $request->order_status;
        $order->total_amount = $privateCart['grand_total'];

        if($request->delivery_date) {
            $deliveryDate = Carbon::createFromFormat('d/m/Y', $request->delivery_date);
            $order->delivery_date = $deliveryDate->format('Y-m-d');
        }

        $order->save();
        CartServices::deleteCart(true);
        return redirect()->route('orders')->with('info', 'Order updated successfully!');

    }


    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('info', 'Order deleted successfully!');
    }


}
