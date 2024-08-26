<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }
        .cart-item-details {
            flex-grow: 1;
            padding-right: 15px;
        }
        .cart-item-details h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .cart-item-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #000;
            border-radius: 20px;
            overflow: hidden;
            background-color: #fff;
            height: 35px;
        }
        .quantity-controls button {
            background-color: #000;
            border: none;
            color: #fff;
            font-size: 18px;
            width: 35px;
            height: 35px;
            cursor: pointer;
        }
        .quantity-controls .quantity {
            width: 35px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .add-more {
            text-align: center;
            color: #ff0000;
            margin: 20px 0;
            cursor: pointer;
        }
        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
        .cart-footer .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .cart-footer .btn-pesan {
            background-color: #ff0000;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Keranjang</h2>
        <div id="cart-items">
            <!-- Item keranjang akan di-render di sini -->
        </div>

        <div class="add-more" onclick="addMoreItems()">+ Tambah</div>

        <div class="cart-footer">
            <div class="total">Total <span id="total-price">Rp 0</span></div>
            <button class="btn-pesan" onclick="checkout()">Pesan</button>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        renderCartItems();

        function renderCartItems() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = ''; // Kosongkan kontainer sebelum diisi ulang

            let totalPrice = 0;

            cart.forEach(item => {
                totalPrice += item.price * item.quantity;

                cartItemsContainer.innerHTML += `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="cart-item-details">
                            <h5>${item.name}</h5>
                            <p>${item.description || ''}</p>
                            <p>Rp ${item.price.toLocaleString()}</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="decrement" onclick="changeQuantity(${item.id}, -1)">&#8722;</button>
                            <div class="quantity">${item.quantity}</div>
                            <button class="increment" onclick="changeQuantity(${item.id}, 1)">&#43;</button>
                        </div>
                    </div>
                `;
            });

            document.getElementById('total-price').innerText = 'Rp ' + totalPrice.toLocaleString();
        }

        function changeQuantity(productId, change) {
            const product = cart.find(item => item.id === productId);
            if (product) {
                product.quantity += change;
                if (product.quantity <= 0) {
                    cart = cart.filter(item => item.id !== productId);
                }
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCartItems();
        }

        function addMoreItems() {
            window.location.href = '/menu'; // Arahkan kembali ke halaman menu
        }

        function checkout() {
            alert('Fitur checkout belum diimplementasikan.');
        }
    </script>
</body>
</html>
