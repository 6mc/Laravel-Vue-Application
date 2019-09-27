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
    public function total_price_calculation()     // This test checks if the price calculation is correct
    {											  // Also checks the creation data on the database
     
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
    public function exceptional_stuation_test()  // Test checks if the exceptional stuation are being done correctly
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
    public function edit_orders_test() 		//  Checking if the edits and calculations are correct in database
    {
  		$id = 	\App\Order::all()->last()->id -1;
     
    	$response = $this->post('edit', [
      	'id' => $id,
        'user' => '1',
        'product' => '2',
        'quantity' => '300'
    ]);

  $this->assertDatabaseHas('orders', [
    'id' => $id,
    'user' => '1',
    'product' => '2',
    'quantity' => '300',
    'total_price' => '384'
]);
    }

    	/** @test */
        public function deletion_test()   // Asserting that deletions works
    {
     	$id = \App\Order::all()->last()->id;  // delete the last added item(s) so Test Database will stay clear and ok

    	$response = $this->post('destroy', [ //first deletion
      	'id' => $id
    ]);

    $response = $this->post('destroy', [     //reason of this deletion is, deleting the two records we added above to keep test DB clear
      	'id' => $id - 1
    ]);										// I usually run my all tests at once so I didnt hesitate using this 

  $this->assertDatabaseMissing('orders', [
    'id' => $id
]);
    }



     /** @test */    
    public function non_existing_user_post()    // we want to see if an user with unknown id can  add records with fake product to database
    {
     	$user = \App\User::all()->last()->id + 10;      // I got 10 more of latest users' id because I want to generate an non existing id
     	$product = \App\Product::all()->last()->id + 10 ; // and we know that ids are incremental not generated randomly. 

    	$response = $this->post('addorder', [
      	'user' => $user,
        'product' => $product,
        'quantity' => '1'
    ]);

  $this->assertDatabaseMissing('orders', [
    'user' => $user,
    'product' => $product
    ]);
    }

/** @test */
public function non_existing_product_edit()  // Check if is it possible to edit an order with non existing product id
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
	public function display_manage_orders_page() // chech if the manage view returns to user proceeds to /manage
	{
	    $response = $this->get('/manage');

	    $response->assertStatus(200);
	    $response->assertViewIs('manage');
	}











}
