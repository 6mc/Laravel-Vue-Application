<?php
namespace App\Http\Controllers;
use App\Order;
use App\Product;
//use Request;
use App\Http\Requests\orderRequest;

class orderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $orders = Order::all();
        $products = Product::all();
        $users = \App\User::all();
        return view('manage', compact('orders', 'users', 'products')); // return the view with these models
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * We dont want unregistered users , products or negative amount of orders so we validate data first
     *
     * we have product id, so we get price of product from database using this id
     * then we calculate total price of order and assign it to total price attribute
     *
     */
    public function store(orderRequest $request) {
        $request->calc();
        $new = Order::create($request->all());                                                     // creating our order into database
       return $new['price'] . "," . $new['total_price'] . "," . $new['user'] . "," . $new['product'] . "," . $new['id'];   // values to client  
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     *
     * We Validate our request data 
     *
     *
     *
     */
    public function update(orderRequest $request, Order $order) {

        $new = $request->calc()->all();
        $order = Order::findorFail($new['id']);             
        $order['product'] = $new['product'];            
        $order['user'] = $new['user'];            
        $order['quantity'] = $new['quantity'];
        $order['price'] = $new['price'];
        $order['total_price'] = $new['total_price']; 
        $order->save();
        return $order['price'] . "," . $order['total_price'];              // Return of new price and  Recalculated Total price
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, orderRequest $request) {
        return Order::destroy($request->all());                            // Destroy the data with requested id              
    }
}
