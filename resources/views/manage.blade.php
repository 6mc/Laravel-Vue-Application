<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Order Management</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css'>
            <link rel="stylesheet" href="./style.css">
            </head>
            <body>
              <div class="container">
                <main id="app">
                  <router-view></router-view>
                </main>
              </div>
              <template id="order-list">
                <div>
                  <div class="actions">
                    <router-link class="btn btn-default" v-bind:to="{path: '/add-order'}">
                      <span class="glyphicon glyphicon-plus"></span>
        Add order
      
                    </router-link>
                  </div>
                  <div class="filters row">
                    <div class="form-group col-sm-3">
                      <label for="search-element">Search</label>
                      <input v-model="searchKey" placeholder="Enter a Search term" class="form-control" id="search-element" requred/>
                    </div>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date 
                          <button v-on:click="change">@{{ date }}</button>
                        </th>
                        <th class="col-sm-2">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filteredorders">
                        <td>
          @{{ order.user }}
        </td>
                        <td>@{{ order.product }}</td>
                        <td>
          @{{ order.price }}
          
                          <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
                        </td>
                        <td>@{{ order.quantity }}</td>
                        <td>@{{ order.total }}
        
                          <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
                        </td>
                        <td>@{{ order.date }}</td>
                        <td>
                          <!-- <router-link class="btn btn-warning btn-xs" v-bind:to="{path: '/order/:order_id/edit', user: 'order-edit', params: {order_id: order.id}, props: true}">Edit</router-link> -->
                          <router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'order-edit', params: {order_id: order.id}}">Edit</router-link>
                          <button class="btn btn-danger btn-xs" @click="remove(order.id)" >Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </template>
              <template id="add-order">
                <div>
                  <h2>Add new order</h2>
                  <form v-on:submit="createorder">
{{ csrf_field() }}
      
                    <div class="form-group">
                      <label for="add-user">User</label>
                      <select required  class="form-control" v-model="order.user"  id="add-user" >
                        <option v-for="user in users"     v-bind:value="user.id" >
    @{{ user.name }}
  </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="add-product">product</label>
                      <select required class="form-control" v-model="order.product" id="add-product" >
                        <option  v-for="product in products" v-bind:value="product.id" >
    @{{ product.name }}
  </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="add-quantity">Quantity 
                      </span>
                    </label>
                    <input required type="number" class="form-control" id="add-quantity" min="1" v-model="order.quantity"/>
                  </div>
                  <button type="submit" class="btn btn-primary">Create</button>
                  <router-link class="btn btn-default" v-bind:to="'/'">Cancel</router-link>
                </form>
              </div>
            </template>
            <template id="order">
              <div>
                <h2>@{{ order.user }}</h2>
                <b>product: </b>
                <div>@{{ order.product }}</div>
                <b>Price:</b>
                <div>@{{ order.price }}
                  <span class="glyphicon glyphicon-euro"></span>
                </div>
                <br/>
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                <router-link v-bind:to="'/'">Back to order list</router-link>
              </div>
            </template>
            <template id="order-edit">
              <div>
                <h2>Edit order</h2>
                <form v-on:submit="updateorder">
                  <div class="form-group">
                    <label for="edit-user">User ( @{{order.user}} ) </label>
                    <select required   class="form-control" v-model="order.userId" id="edit-user" >
                      <option v-for="user in users" v-bind:value="user.id" >
    @{{ user.name }}
  </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="edit-product">Product ( @{{order.product}} )</label>
                    <select required v-bind:value="order.product"   class="form-control" v-model="order.productId"  >
                      <option v-for="product in products"  v-bind:value="product.id" >
    @{{ product.name }}
  </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="edit-quantity">Quantity ( @{{order.quantity}} )
                    </span>
                  </label>
                  <input required min="1" type="number" class="form-control" id="edit-quantity" v-model="order.quantity"/>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <router-link class="btn btn-default" v-bind:to="'/'">Cancel</router-link>
              </form>
            </div>
          </template>
        </body>
      </html>
      <!-- partial -->
      <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.js'></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.2.1/vue-router.js'></script>
      <script >
  
  // filling the users array with the data sent from orderController 

  var users = [
 @foreach($users as $user)
  {id: {{$user->id}}, name: '{{$user->name}}' },
  @endforeach
  {id: 3, name: 'Ayse', adress: "Talinn"}
  ];

  // filling the products array with the data sent from orderController 
var products = [
  @foreach($products as $product)
 {id: {{$product->id}}, name: "{{$product->name}}" },
  @endforeach
  {id: 2, name: 'Pepsi Cola', price: 100}
  
  ];
 // filling the orders array with the data sent from orderController 

var orders = [
@foreach($orders as $order)
  {id: {{$order->id}}, user: users[findKey({{$order->user}}, users)].name, product: products[findKey({{$order->product}}, products)].name, price: {{$order->price}}, quantity: {{$order->quantity}}, total:{{$order->total_price}}, userId:{{$order->user}}, productId:{{$order->product}} ,  date:"{{$order->created_at}}"},
@endforeach
  {id: 3, user: 'Diego', product: 'Superheroic JavaScript MVW Framework.', price: 100, quantity: 1, total:100,  date:"21.09.2019 18:00"}
];
  


orders.pop();  //removing the dummy elements in  arrays  
products.pop();
users.pop();

orders= orders.reverse();  //reversing  array to see latest added orders first



function findorder (orderId) {                // this functions will be used because,  data in the database stored as ids not names
  return orders[findKey(orderId, orders)];       // example data: id:42, user: 1, product: 2, price... -> order stores the user's id not his/her name
};                                            




function findKey(Id, array)       // returns element from id 
{
for (var key = 0; key < array.length; key++) {
    if (array[key].id == Id) {
      return key;
    }
  }
};




var List = Vue.extend({                         //this is  vue template to list orders
  template: '#order-list',
    methods: {

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
      },

      remove (index) {                          //this is the function that work when we click on delete button
      orders.splice(findKey(index, orders), 1);   // deletes order from orders array, so it will be deleted from the screen
      axios.post('/destroy', {                  //sending id of order that we want to delete, to destroy route and it will be deleted from DB too
      id:index
    })
    .then(function (response) {
     console.log(response);
    })
    .catch(function (error) {
     console.log(error);
    });


      }
    },
  data: function () {  //  datas which are used in this template
    return {orders: orders, searchKey: '', date: 'All', options: ['7 days', 'today', 'All'], i:0 , rDate: 0};
  },
  computed: {       // this is  filtering system
    filteredorders: function () {     //  view gets orders from filteredorders, not orders.
      return this.orders.filter(function (order) {  //so this anoymous function will return data by date and(&&) keywords
        return  ( new Date(order.date).getDate() >= this.rDate  ) && ( this.searchKey=='' ||order.user.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1 || order.product.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1);  
      },this);
    }
  }
});



var orderEdit = Vue.extend({    // this is the vue template that show us edit screen
  template: '#order-edit',
  data: function () {   // datas that we will use on edit
    return { orders: orders, users: users, products: products, order: findorder(this.$route.params.order_id)};
  },
  methods: {
    updateorder: function () {           // function that will run when the save button clicked after edits done
           var order = this.order;      //  order object is sent by vue routes as params 
var key = findKey(order.id,orders);       // we find  order and delete 
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
        user: users[findKey(order.userId,users)].name,
        userId:order.userId,                                  //splice will create data on screen on  where it used to be so sort wont change
        product: products[findKey(order.productId, products)].name,
        productId: order.productId,
        quantity: order.quantity,
        price: response.data.split(",")[0],               // here price and total price sent us from server 
        total: response.data.split(",")[1],               // calculations on client-side are risky and manipulative   
        date: order.date

     });

    })
    .catch(function (error) {
     console.log(error);
    });

    router.push('/');               
    }
  }
});




var Addorder = Vue.extend({         // the template we use to add orders 
  template: '#add-order',
  data: function () {
    return {order: {user: '', product: '', quantity: ''},users: users, products:products}
  },
  methods: {
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
        user: users[findKey(order.user, users)].name,
        product: products[findKey(order.product, products)].name,
        quantity: order.quantity,
        price: response.data.split(",")[0],         // also here price and total price calculated in server and returned to us as a response
        total: response.data.split(",")[1],         
        userId: response.data.split(",")[2],
        productId: response.data.split(",")[3],
        date: new Date()

      });


      })
      .catch(function (error) {
        console.log(error);
      });

      router.push('/');
    }
  }
});



var router = new VueRouter({routes:[
  { path: '/', component: List},                              //vue routes 
  { path: '/add-order', component: Addorder},
  { path: '/order/:order_id/edit', component: orderEdit, name: 'order-edit'}
]});
app = new Vue({

 
  router:router
}).$mount('#app')

      </script>
    </body>
  </html>