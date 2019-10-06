<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $table='products';


    protected $fillable = [
        'name', 'price',  'photo', 'description'
    ];



        public function orders()
    {
        return $this->hasMany('App\Order', 'product');
    }



}
