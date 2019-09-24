<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Request;


class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $orders =  Order::all();
       $products = Product::all();
       $users = \App\User::all();
        return view('manage', compact('orders','users','products'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
       $req =Request::all();
       $req['price'] = Product::findorFail($req['product'])->price;
       $req['total_price'] = $req['quantity'] * $req['price'];
       if ($req['product']=="2" && $req['quantity']>2) {
           $req['total_price']= $req['total_price']-(($req['total_price']*20)/100);
            $req['total_price'] = round($req['total_price'], 2);
        }
   Order::create($req);
   return $req['price'].",".$req['total_price']; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
          return Order::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $new = Request::all();

        $order = Order::findorFail($new['id']);

        $order['product'] = $new['product'];
         $order['user'] = $new['user'];
          $order['quantity'] = $new['quantity'];
          $order['price']=Product::findorFail($new['product'])->price;
        $order['total_price']= $order['quantity'] *  $order['price'];
    
        if ($order['product']=="2" && $order['quantity']>2) {
           $order['total_price']= $order['total_price']-(($order['total_price']*20)/100);
            $order['total_price'] = round($order['total_price'], 2);
        }
          $order->save();
       return $order['price'].",".$order['total_price']; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order,Request $request)
    {
        
        
       return Order::destroy(Request::all());
 
    }
}
