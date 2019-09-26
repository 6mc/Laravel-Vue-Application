<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainTest extends TestCase
{

		
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
     /** @test */
    public function total_price_calculation()
    {
     
    	$response = $this->post('addorder', [
        'user' => '1',
        'product' => '1',
        'quantity' => '8'
    ]);

  $this->assertDatabaseHas('orders', [
    'user' => '1',
    'product' => '1',
    'quantity' => '8',
    'total_price' => '14.4'
]);
    }


     /** @test */
    public function exceptional_stuation_test()
    {
     
    	$response = $this->post('addorder', [
        'user' => '1',
        'product' => '2',
        'quantity' => '30'
    ]);

  $this->assertDatabaseHas('orders', [
    'user' => '1',
    'product' => '2',
    'quantity' => '30',
    'total_price' => '38.4'
]);
    }

     /** @test */    
    public function edit_orders_test()
    {
     
    	$response = $this->post('edit', [
      	'id' => '43',
        'user' => '1',
        'product' => '2',
        'quantity' => '300'
    ]);

  $this->assertDatabaseHas('orders', [
    'id' => '43',
    'user' => '1',
    'product' => '2',
    'quantity' => '300',
    'total_price' => '384'
]);
    }

    	/** @test */
        public function deletion_test()
    {
     $id = \App\Order::all()->last()->id;

    	$response = $this->post('destroy', [
      	'id' => $id
    ]);

  $this->assertDatabaseMissing('orders', [
    'id' => $id
]);
    }



     /** @test */    
    public function non_existing_user_post()
    {
     
    	$response = $this->post('addorder', [
      	'user' => '3',
        'product' => '2',
        'quantity' => '1'
    ]);

  $this->assertDatabaseMissing('orders', [
    'user' => '3',
    'product' => '2',
    ]);
    }

/** @test */
public function non_existing_product_edit()
    {
     
    	$response = $this->post('addorder', [
    		'id' => '43',
      	'user' => '2',
        'product' => '3',
        'quantity' => '0'
    ]);

  $this->assertDatabaseMissing('orders', [
    'user' => '2',
    'product' => '3',
    'quantity' => '0'
    ]);
    }





	/** @test */
	public function display_manage_orders_page()
	{
	    $response = $this->get('/manage'	);

	    $response->assertStatus(200);
	    $response->assertViewIs('manage');
	}











}
