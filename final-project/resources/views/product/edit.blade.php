@extends('layouts.app')





@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Product Name:</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                    required>
            </div>
            <div class="my-4form-group">
                <label class="my-2" for="category_id">Category:</label>
                <select name="category" class="form-control" required>
                    <option value="{{ old('category', $product->category) }}">
                        {{ old('category', $product->category) }}</option>
                    @foreach ($categories as $category)
                        <option style="color: black" value="{{ $category->title }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class=" my-3 btn btn-primary">update Product</button>
        </form>
    </div>
@endsection
