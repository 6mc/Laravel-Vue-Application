<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    	protected $table='orders';


    protected $fillable = [
        'user', 'product', 'price' ,  'quantity', 'total_price'
    ];

    public function User()
    {
        return $this->belongsTo('App\User','id', 'user');
    }

        public function Product()
    {
        return $this->belongsTo('App\Product','id', 'product');
    }

}
