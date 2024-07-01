<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .product {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .price {
            color: green;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="product">
        <h1 id="productTitle">{{ $product->name }}</h1>
        <img id="productImage" src="{{ $product->image_url }}" alt="Product Image">
        <p id="productDescription">{{ $product->description }}</p>
        <p class="price" id="productPrice">${{ $product->price }}</p>
    </div>
</body>
</html>