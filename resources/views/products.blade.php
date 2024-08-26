<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    <h1>Menu</h1>
    <div id="app">
        <div v-for="product in products" :key="product.id">
            <h3>@{{ product.name }}</h3>
            <p>@{{ product.description }}</p>
            <p>Price: @{{ product.price }}</p>
            <button @click="addToCart(product)">Add to Cart</button>
        </div>
        <h2>Cart</h2>
        <div v-for="item in cart" :key="item.id">
            <p>@{{ item.name }} - Quantity: @{{ item.quantity }}</p>
        </div>
        <button @click="checkout">Checkout</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                products: [],
                cart: []
            },
            created() {
                axios.get('/products').then(response => {
                    this.products = response.data;
                });
            },
            methods: {
                addToCart(product) {
                    let item = this.cart.find(item => item.id === product.id);
                    if (item) {
                        item.quantity++;
                    } else {
                        this.cart.push({...product, quantity: 1});
                    }
                },
                checkout() {
                    let orderDetails = this.cart.map(item => ({
                        product_id: item.id,
                        quantity: item.quantity
                    }));

                    axios.post('/orders', {
                        table_id: 1, // Example table ID
                        order_details: orderDetails,
                        total_price: this.cart.reduce((total, item) => total + item.price * item.quantity, 0)
                    }).then(response => {
                        alert(response.data.message);
                        this.cart = [];
                    });
                }
            }
        });
    </script>
</body>
</html>
