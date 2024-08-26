<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .checkout-header {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        .checkout-header h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            flex-grow: 1;
            text-align: center;
        }
        .checkout-container {
            padding: 20px 15px;
        }
        .checkout-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
            margin-bottom: 15px;
        }
        .checkout-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }
        .checkout-item-details {
            flex-grow: 1;
        }
        .checkout-item-details h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .checkout-item-details p {
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
            background-color: #fff;
            border: none;
            color: #000;
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
        .checkout-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: 100%;
            max-width: 768px;
            box-shadow: 0px -1px 6px rgba(0, 0, 0, 0.1);
        }
        .checkout-footer .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .checkout-footer .btn-order {
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
    <div class="checkout-header">
        <a href="/menu" class="btn btn-link">&larr;</a>
        <h2>Keranjang</h2>
    </div>

    <div class="container checkout-container">
        <div id="checkout-items">
            <!-- Item checkout akan di-render di sini -->
        </div>

        <div class="add-more" onclick="addMoreItems()">+ Tambah</div>
    </div>

    <div class="checkout-footer">
        <div class="total">Total: <span id="total-price">Rp 0</span></div>
        <button class="btn-order" onclick="processOrder()">Pesan</button>
    </div>

    <script>
        // Mengambil data keranjang dari localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        function renderCheckoutItems() {
            const checkoutItemsContainer = document.getElementById('checkout-items');
            checkoutItemsContainer.innerHTML = ''; // Kosongkan kontainer sebelum diisi ulang

            let totalPrice = 0;

            // Menampilkan item di keranjang
            Object.values(cart).forEach(item => {
                totalPrice += item.price * item.quantity;

                checkoutItemsContainer.innerHTML += `
                    <div class="checkout-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="checkout-item-details">
                            <h5>${item.name}</h5>
                            <p>Rp ${item.price.toLocaleString()}</p>
                        </div>
                        <div class="quantity-controls">
                            <button onclick="changeQuantity(${item.id}, -1)">&#8722;</button>
                            <div class="quantity">${item.quantity}</div>
                            <button onclick="changeQuantity(${item.id}, 1)">&#43;</button>
                        </div>
                    </div>
                `;
            });

            document.getElementById('total-price').innerText = 'Rp ' + totalPrice.toLocaleString();
        }

        function changeQuantity(productId, change) {
            if (cart[productId]) {
                cart[productId].quantity += change;
                if (cart[productId].quantity <= 0) {
                    delete cart[productId];
                }
            }

            // Simpan kembali ke localStorage setelah perubahan
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCheckoutItems(); // Render ulang item
        }

        function addMoreItems() {
            window.location.href = '/menu'; // Arahkan kembali ke halaman menu
        }

        function processOrder() {
            alert('Pesanan Anda sedang diproses. Terima kasih!');
            localStorage.removeItem('cart'); // Menghapus data keranjang setelah pemesanan
            window.location.href = '/menu'; // Arahkan kembali ke halaman menu setelah memesan
        }

        // Render item checkout saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            renderCheckoutItems();
        });
    </script>
</body>
</html>
