<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'user' => 'exists:users,id', 'product' => 'exists:products,id', 'quantity' => 'min:1|integer'
        ];
    }


    public function calc()
    {   

         $this['price'] = \App\Product::findorFail($this['product'])->price;
        $this['total_price'] = $this['quantity'] * $this['price'];
        if ($this['product'] == "2" && $this['quantity'] > 2) {                        // checking if exceptional stuation takes place
            $this['total_price'] = $this['total_price'] - (($this['total_price'] * 20) / 100); //if yes, 20% discount on total price is being applied
                               // and we don't want long digits after points 
        }
         $this['total_price'] = round($this['total_price'], 2);   
 
        return $this;


    }




}
