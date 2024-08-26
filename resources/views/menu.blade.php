<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .menu-header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .category-buttons {
            display: flex;
            justify-content: start;
            align-items: center;
            margin: 15px 0;
            overflow-x: auto;
            white-space: nowrap;
        }
        .category-buttons button {
            border: none;
            background: none;
            margin-right: 10px;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            background-color: #f0f0f0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .category-buttons button.active {
            background-color: #000;
            color: #fff;
        }
        .category-buttons button:hover {
            background-color: #000;
            color: #fff;
        }
        .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 10px;
        }
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
            transition: transform 0.3s ease;
        }
        .product:hover img {
            transform: scale(1.05);
        }
        .product-details {
            flex-grow: 1;
        }
        .product-details h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            transition: color 0.3s ease;
        }
        .product-details h5:hover {
            color: #007bff;
        }
        .product-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .product-details .price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #28a745;
            border-radius: 20px;
            overflow: hidden;
            background-color: #fff;
            height: 40px;
            transition: background-color 0.3s ease;
        }
        .quantity-controls button {
            background-color: #fff;
            border: none;
            color: #28a745;
            font-size: 20px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .quantity-controls button:hover {
            background-color: #28a745;
            color: #fff;
        }
        .quantity-controls .quantity {
            width: 40px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .cart {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff0000;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .cart:hover {
            transform: scale(1.1);
        }
        .cart-icon {
            margin-right: 10px;
        }
        .cart-icon svg {
            fill: white;
            width: 20px;
            height: 20px;
        }
        .cart .cart-item-count {
            background-color: white;
            color: #ff0000;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 14px;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="menu-header">
        <h1>Urban Plus Coffee & Kitchen</h1>
    </div>

    <div class="container mt-3">
        <!-- Tombol kategori dinamis -->
        <div class="category-buttons">
            @foreach($productsByCategory as $category => $products)
                <button onclick="scrollToCategory('{{ $category }}')">{{ $category }}</button>
            @endforeach
        </div>

        <!-- Example of dynamic product rendering -->
        @foreach($productsByCategory as $category => $products)
            <div class="category" id="category-{{ $category }}">
                <h2>{{ $category }}</h2>
                @foreach($products as $product)
                    <div class="product">
                        <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}">
                        <div class="product-details">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ $product->description }}</p>
                            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="decrement" data-product-id="{{ $product->id }}">&#8722;</button>
                            <div class="quantity" id="quantity-{{ $product->id }}">0</div>
                            <button class="increment" data-product-id="{{ $product->id }}">&#43;</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div id="cart" class="cart" style="display: none;" onclick="goToCheckout()">
        <div class="cart-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 20c-1.1 0-1.99.9-1.99 2S8.9 24 10 24s2-.9 2-2-.9-2-2-2zm0 3c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm7-3c-1.1 0-1.99.9-1.99 2S15.9 24 17 24s2-.9 2-2-.9-2-2-2zm0 3c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm1.14-13.25l-.86 6c-.12.86-.85 1.5-1.72 1.5H9.34c-.86 0-1.6-.64-1.72-1.5l-.86-6C6.62 6.66 7.36 6 8.22 6h7.56c.87 0 1.61.66 1.72 1.75zM18.54 4H5.46L4.94 1.6C4.8.67 4.02 0 3.06 0H1C.45 0 0 .45 0 1s.45 1 1 1h2l.52 2.4 1.68 11.76C5.55 17.81 6.67 19 8.02 19h7.96c1.35 0 2.47-1.19 2.82-2.84L20.48 5.4c.03-.17.05-.34.05-.51 0-.83-.67-1.5-1.5-1.5z"/></svg>
        </div>
        <span>Keranjang:</span>
        <span class="cart-item-count" id="cart-count">0</span>
    </div>

    <script>
        // Menghapus data cart di localStorage ketika halaman dimuat
        localStorage.removeItem('cart'); // Mengatur ulang cart

        let cart = {};

        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.closest('.product').querySelector('h5').innerText;
                const productPrice = parseInt(this.closest('.product').querySelector('.price').innerText.replace(/[^0-9]/g, ''));
                const productImage = this.closest('.product').querySelector('img').src;

                if (!cart[productId]) {
                    cart[productId] = {
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        quantity: 1
                    };
                } else {
                    cart[productId].quantity++;
                }

                document.getElementById('quantity-' + productId).innerText = cart[productId].quantity;
                updateCart();
            });
        });

        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');

                if (cart[productId] && cart[productId].quantity > 0) {
                    cart[productId].quantity--;
                    document.getElementById('quantity-' + productId).innerText = cart[productId].quantity;
                    if (cart[productId].quantity === 0) {
                        delete cart[productId];
                    }
                }
                updateCart();
            });
        });

        function updateCart() {
            let cartCount = 0;
            for (const id in cart) {
                cartCount += cart[id].quantity;
            }
            document.getElementById('cart-count').innerText = cartCount;

            if (cartCount > 0) {
                document.getElementById('cart').style.display = 'flex';
                localStorage.setItem('cart', JSON.stringify(cart));
            } else {
                document.getElementById('cart').style.display = 'none';
                localStorage.removeItem('cart');
            }
        }

        function goToCheckout() {
            window.location.href = '/checkout';
        }

        function scrollToCategory(category) {
            const categoryElement = document.getElementById('category-' + category);
            if (categoryElement) {
                categoryElement.scrollIntoView({ behavior: 'smooth' });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCart();
        });
    </script>
</body>
</html>
