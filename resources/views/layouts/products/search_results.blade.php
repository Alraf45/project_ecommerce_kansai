<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
</head>
<body>
    <h1>Search Results for "{{ request('query') }}"</h1>

    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    - ${{ number_format($product->price, 2) }}
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>