<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        h1::after {
            content: '';
            width: 60px;
            height: 4px;
            background-color: #007bff;
            display: block;
            margin: 8px auto 0;
            border-radius: 2px;
        }
        .product-form {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .product-form:hover {
            background-color: #e9ecef;
            transform: scale(1.02);
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            transform: translateY(-2px);
        }
        .alert-success {
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Products</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.products.storeMultiple') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="product-forms">
                <div class="product-form mb-4">
                    <h4>Product 1</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="products[0][name]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="products[0][description]" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="products[0][price]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="products[0][image]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="products[0][category]" class="form-control" required>
                            <option value="International Food">Culture Menu</option>
                            <option value="International Food">International Food</option>
                            <option value="Rice Bowl">Rice Bowl</option>
                            <option value="Sandwich & Burger">Sandwich & Burger</option>
                            <option value="Milk Based">Milk Based</option>
                            <option value="Coffee based">Coffee Based</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" id="add-product" class="btn btn-secondary mb-1">Add Another Product</button>
            <button type="submit" class="btn btn-primary">Add Products</button>
        </form>
    </div>

    <script>
        let productCount = 1;

        document.getElementById('add-product').addEventListener('click', function() {
            const productForms = document.getElementById('product-forms');
            const newProductForm = document.createElement('div');
            newProductForm.classList.add('product-form', 'mb-4');
            newProductForm.innerHTML = `
                <h4>Product ${productCount + 1}</h4>
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="products[${productCount}][name]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="products[${productCount}][description]" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="products[${productCount}][price]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="products[${productCount}][image]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="products[${productCount}][category]" class="form-control" required>
                        <option value="Culture Menu">Culture Menu</option>
                        <option value="International Food">International Food</option>
                        <option value="Rice Bowl">Rice Bowl</option>
                        <option value="Sandwich & Burger">Sandwich & Burger</option>
                        <option value="Milk Based">Milk Based</option>
                        <option value="Coffee based">Coffee Based</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            `;
            productForms.appendChild(newProductForm);
            productCount++;
        });
    </script>
</body>
</html>
