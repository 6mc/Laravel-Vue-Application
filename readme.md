
<a href="https://travis-ci.org/laravel/framework"><img src="https://img.shields.io/badge/test-passing-brightgreen" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/laravel-5.5-green "></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/vueJS-2.1.1-green" ></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/Bootstrap-3.3.7-green"></a>
</p>

- [About Project](#About-Project)
- [Database](#Database)
- [Add](#Add)
- [Edit](#Edit)
- [Delete](#Delete)
- [Keyword & Date Filter](#Filters)
- [Tests](#Tests)
- [Bugs](#bugs--Improvements)

## About Project 
Project is currenly live on [mhmt.gq/manage](http://mhmt.gq/manage)

This is an order management application. Used MySQL as a database but it doesnt matter as long as you use laravel. You can migrate to any database using migration files. 

All the datas are being  sent to client side and VueJS is parsing data and passing them to html. So structure is like Laravel->Vue App-> HTML view 

And for CRUD functions to Server-Side I used Ajax requests with Axios. Also I included relevant unit tests. 

## Database

##### The Database Structure is like this 

| Users       | Products        | Orders  |
| ------------- |:-------------:| -----:|
| id         | id             | id | 
| name     | name           |   product |
| password       | price         |    user |
| e-mail|created_at | price|
|Address|updated_at| total_price|
|created_at||created_at|
|updated_at||updated_at|

### Database Notes
- in orders table, product and user field are storing IDs' of them. Not the names
- price is constant that stores the price of product when the order created  and total_price field are being calculated in controller. It could be also auto calculated in Model or in Database. 

 ## Add
 ### server-side
- app\Http\Controllers\orderController.php
 - First I validate the Request 
 -  I get the price
 - Calculate the total price 
 - check if exceptional stuation takes place
 - Add Request to Database
 - Return price total price and id  values to client
```PHP

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
    }'
```

 ### client-side
 - resources\views\manage.blade.php
 - orders array is being showed to user in HTML  simulatenously. 
- After Sending post request, add new element to orders array.
```javascript
    createorder: function() {
      var order = this.order;
    

        axios.post('/addorder', {  // sending post request to addorder route so it will add  data to database using  controller
        user: order.user,
        product: order.product,
        quantity: order.quantity
      })
      .then(function (response) { //  we make sure that our data received by server
       
        // used unshift instead of push because I want to add it to top of the list  
  orders.unshift({                //  adding  new order to  order array so it will be shown on the screen
        id: response.data.split(",")[4],
        user: users[finduserKey(order.user)].name,
        product: products[findproductKey(order.product)].name,
        quantity: order.quantity,
        price: response.data.split(",")[0],         // also here price and total price calculated in server and returned to us as a response
        total: response.data.split(",")[1],         
        userId: response.data.split(",")[2],
        productId: response.data.split(",")[3],
        date: new Date()

      });


      })
```

## Edit 
### server-side
- app\Http\Controllers\orderController.php
- Very similar to addition function
- Getting the model using id in Request
- Return new price and total price values
```PHP
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
```
### client side
- resources\views\manage.blade.php
- Removing the element from orders array
-  when we got the success response, adding it to its place(same order) with response values  
  
```Javascript
 updateorder: function () {           // function that will run when the save button clicked after edits done
           var order = this.order;      //  order object is sent by vue routes as params 
var key = findorderKey(order.id);       // we find  order and delete 
orders.splice(key, 1);                    

           axios.post('/edit', {    // here we are sending a post request to  edit route which will run edit function in  controller
      id:order.id,
      user: order.userId,
      product: order.productId,
      quantity: order.quantity
    })
    .then(function (response) {
     console.log(response);

     orders.splice(key, 0, {              // after we make sure that we have the data edited in DB we are creating new object in  orders with 
              id: order.id,               // values we sent to database
        user: users[finduserKey(order.userId)].name,
        userId:order.userId,                                  //splice will create data on screen on  where it used to be so sort wont change
        product: products[findproductKey(order.productId)].name,
        productId: order.productId,
        quantity: order.quantity,
        price: response.data.split(",")[0],               // here price and total price sent us from server 
        total: response.data.split(",")[1],               // calculations on client-side are risky and manipulative   
        date: order.date

     });
```

## Delete

### server-side
- app\Http\Controllers\orderController.php
- Delete order record which has the requests' id value
```php
    public function destroy(Order $order, Request $request) {
        return Order::destroy(Request::all());                            // Destroy the data with requested id              
    }
```
### client-side
- resources\views\manage.blade.php
- Remove it from Orders Array
- Post request to /destroy route using id as data
```JavaScript
      remove (index) {                          //this is the function that work when we click on delete button
      orders.splice(findorderKey(index), 1);   // deletes order from orders array, so it will be deleted from the screen
      axios.post('/destroy', {                  //sending id of order that we want to delete, to destroy route and it will be deleted from DB too
      id:index
    })
```

## Filters
- Filtering is running only in client-side, because we don't have pagination and we have all the data with us so we can just filter it on client side
### client-side 
- resources\views\manage.blade.php
- HTML gets data from orders but it get it's from filteredorders not just orders
```html
<tr v-for="order in filteredorders">
```
- So it will return us a filtered data and as you can see there is a && sign so we can filter by date and the keyword at the same time

```js
  computed: {       // this is  filtering system
    filteredorders: function () {     //  view gets orders from filteredorders, not orders.
      return this.orders.filter(function (order) {  //so this anoymous function will return data by date and(&&) keywords
        return  ( new Date(order.date).getDate() >= this.rDate  ) && ( this.searchKey=='' ||order.user.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1 || order.product.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1);  
      },this);
    }
  }
```
- Let's take a look in our  keywords filtering first
I use toLowerCase function because I want my search to be case insensitive
then I use indexOf function to see if any order's user has any part of my searchkey if there's no match it will return -1 so,  if not equals to -1 it matches
-  Done same thing for the product
#####  *But in orders field we just have bunch of IDs, How can we match IDs with keywords  ?*
##### -  *That's Right, so to prevent that data mismatch, In orders array we have both IDs and names as data unlike its database field*
```php
@foreach($orders as $order)
  {id: {{$order->id}}, user: users[finduserKey({{$order->user}})].name, product: products[findproductKey({{$order->product}})].name, price: {{$order->price}}, quantity: {{$order->quantity}}, total:{{$order->total_price}}, userId:{{$order->user}}, productId:{{$order->product}} ,  date:"{{$order->created_at}}"},
@endforeach
```
##### -  *As you can see in the codeblock above, finduserKey function help us gets user's key by using user's id so we can get user's name from its object*


### Date Filtering 
- We will get day numbers from date functions and we will filter dates by comparing them(>=)
- rDate is reference day if we want to see todays order we will set reference day to      -today and make its value equals to today's day number value 

	if we want to see last seven days' orders we can set our reference Date's day number  value to today - 7

	and if we want to see all orders we can just set rDate to 0 so all day numbers will be greater than its value


```js
      change(){                                 // this method is being used for filtering orders by date

        this.date = this.options[this.i++%3];    // change  text to next element e.g. last 7 days -> today

        if (this.i%3==1) {
        this.rDate = new Date().getDate() - 7 ;   // we will see the orders that have greater date value than the reference Date 
    }                                             //  so in this if state  reference date is today - 7 days, because we want last 7 days
       if (this.i%3==2) {
        this.rDate = new Date().getDate();        // reference date is today which will show us orders only added today
    }
       if (this.i%3==0) {
        this.rDate = 0 ;                        // reference date is 0 which is lower than all date value so it will show us all orders
    }
      }
```
## Tests
- tests\Unit\MainTest.php
- I usually code tests with Python but laravel has this lib in it, so I wanted to try
- I was going to include front-end browser tests but I remembered that they are not called Unit tests
- In this test  file in general we check
  * Add Requests
  * Update Requests
  * Delete Requests
  * Price Calculations
  * Seeing the right View
  * Request Validations 
```php
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
     	$product = \App\Product::all()->last()->id + 10 ; // and we know that IDs are incremental not generated randomly. 

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
```
### Bugs & Improvements
- Date's day number gets value only in between 0-31 so start of every month Date filtering won't work correctly.
- When a new order added, its time value format is different than others make them all in same format.
- Users only needs to be sended to client when add or edit function called by client it may reduce the load on server side <- listing orders will be problem in this case server-side reorganizations will be needed
- Using an external Database and let it do the calculations will reduce load as well
- Pagination and Filtering on server-side might be needed in case of large scale data recorded

"Thanks for your precious time"
-*Mehmet Can*