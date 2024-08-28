@extends('layouts.app')




@section('content')
    <div class="container">
        <h1>Add New Product</h1>

        <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Product Name:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="main_photo">Main Photo:</label>
                <input class="d-block" type="file" name="main_photo" id="main_photo">
            </div>
            <div class="form-group">
                <label class="d-block" for="additional_photos">Additional Photos:</label>
                <input class="d-block" type="file" name="additional_photo_1" id="additional_photo_1">
                <input class="d-block" type="file" name="additional_photo_2" id="additional_photo_2">
                <input class="d-block" type="file" name="additional_photo_3" id="additional_photo_3">
                <input class="d-block" type="file" name="additional_photo_4" id="additional_photo_4">
            </div>
            <div class=" my-4form-group">
                <label class="my-2" for="category_id">Category:</label>
                <select name="category" class="form-control" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option style="color: black" value="{{ $category->title }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class=" my-3 btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
