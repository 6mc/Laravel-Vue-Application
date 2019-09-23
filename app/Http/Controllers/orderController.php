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
        return view('manage', compact('orders'));
      
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
        //
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
