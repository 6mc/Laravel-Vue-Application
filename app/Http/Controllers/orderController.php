<?php
namespace App\Http\Controllers;
use App\Order;
use App\Product;
use Request;
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
    public function store(Request $request) {
        Request::validate(['user' => 'exists:users,id', 'product' => 'exists:products,id', 'quantity' => 'min:1', ]);
        $req = Request::all();
        $req['price'] = Product::findorFail($req['product'])->price;
        $req['total_price'] = $req['quantity'] * $req['price'];
        if ($req['product'] == "2" && $req['quantity'] > 2) {                        // checking if exceptional stuation takes place
            $req['total_price'] = $req['total_price'] - (($req['total_price'] * 20) / 100); //if yes, 20% discount on total price is being applied
            $req['total_price'] = round($req['total_price'], 2);                        // and we don't want long digits after points 
        }
        $new = Order::create($req);                                                     // creating our order into database
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
    public function update(Request $request, Order $order) {

        Request::validate(['id' => 'exists:orders,id','user' => 'exists:users,id', 'product' => 'exists:products,id', 'quantity' => 'min:1', ]);
        $new = Request::all();
        $order = Order::findorFail($new['id']);             
        $order['product'] = $new['product'];            
        $order['user'] = $new['user'];            
        $order['quantity'] = $new['quantity'];
        $order['price'] = Product::findorFail($order['product'])->price;  // getting the price of new data 
        $order['total_price'] = $order['quantity'] * $order['price'];     // Recalculating the total prices  
        if ($order['product'] == "2" && $order['quantity'] > 2) {         // 
            $order['total_price'] = $order['total_price'] - (($order['total_price'] * 20) / 100);
            $order['total_price'] = round($order['total_price'], 2);
        }
        $order->save();
        return $order['price'] . "," . $order['total_price'];              // Return of new price and  Recalculated Total price
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Request $request) {
        return Order::destroy(Request::all());                            // Destroy the data with requested id              
    }
}
