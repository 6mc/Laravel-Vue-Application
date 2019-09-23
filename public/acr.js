var users = [
  {id: 1, name: 'Mehmet', adress: "World"},
  {id: 2, name: 'Ali', adress: "Mersin"},
  {id: 3, name: 'Ayse', adress: "Talinn"}
  ];

var products = [
  {id: 1, name: 'Coca Cola', price: 100},
  {id: 2, name: 'Pepsi Cola', price: 100}
  
  ];


var orders[];

  axios.get('/showorders')
  .then(function (response) {
    // handle success
    console.log(response.data);
 orders = response.data;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .finally(function () {
    // always executed
  });

function findorder (orderId) {
  return orders[findorderKey(orderId)];
};



function findorderKey (orderId) {
  for (var key = 0; key < orders.length; key++) {
    if (orders[key].id == orderId) {
      return key;
    }
  }
};

var List = Vue.extend({
  template: '#order-list',
    methods: {
      remove (index) {
      orders.splice(findorderKey(index), 1);
      }
    },
  data: function () {
    return {orders: orders, searchKey: ''};
  },
  computed: {
    filteredorders: function () {
      return this.orders.filter(function (order) {
        return this.searchKey=='' || order.user.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1 || order.product.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1;
      },this);
    }
  }
});

var order = Vue.extend({
  template: '#order',
  data: function () {
    return {order: findorder(this.$route.params.order_id)};
  }
});

var orderEdit = Vue.extend({
  template: '#order-edit',
  data: function () {
    return {orders: orders, users: users, products: products, order: findorder(this.$route.params.order_id)};
  },
  methods: {
    updateorder: function () {
           var order = this.order;
      orders[findorderKey(order.id)] = {
        id: order.id,
        user: order.user,
        product: order.product,
        quantity: order.quantity
      };
      router.push('/');
    }
  }
});




var Addorder = Vue.extend({
  template: '#add-order',
  data: function () {
    return {order: {user: '', product: '', quantity: ''},users: users, products:products}
  },
  methods: {
    createorder: function() {
      var order = this.order;
      orders.push({
        id: Math.random().toString().split('.')[1],
        user: order.user,
        product: order.product,
        quantity: order.quantity
        // Ajax Response will be the total price and price and date

      });

        axios.post('/addorder', {
        user: order.user,
        product: order.product,
        quantity: order.quantity
      })
      .then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });

      router.push('/');
    }
  }
});



var router = new VueRouter({routes:[
  { path: '/', component: List},
  { path: '/order/:order_id', component: order, user: 'order'},
  { path: '/add-order', component: Addorder},
  { path: '/order/:order_id/edit', component: orderEdit, name: 'order-edit'}
//  { path: '/order/:order_id/delete', component: orderDelete, user: 'order-delete'}
]});
app = new Vue({
 
  router:router
}).$mount('#app')