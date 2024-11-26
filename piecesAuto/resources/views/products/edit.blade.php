<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $product->name }}"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $product->description }}</textarea><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="{{ $product->price }}"><br>
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
