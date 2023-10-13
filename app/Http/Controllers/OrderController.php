<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function orderList()
    {
        $orderItems = Order::getContent();
        // dd($orderItems);
        return view('order', compact('orderItems'));
    }

    public function store(Request $request)
    {

    // Create a new order
    $order = new Order();
    $order->customer_id = auth()->user()->id; // Assuming you have authentication
    $order->total_amount = 0; // Initialize the total amount

    foreach(session('cart') as $id => $details) {
        // Add the cart items to the order
        $order->orderItems()->create([
            'product_id' => $id,
            'quantity' => $details['quantity'],
            'price' => $details['price'],
        ]);

        // Update the total amount
        $order->total_amount += $details['quantity'] * $details['price'];
    }

    // Set other order details (e.g., order status)

    // Save the order
    $order->save();

    // Clear the cart (if necessary)
    session()->forget('cart');

    // Redirect or respond with success message
}
}
