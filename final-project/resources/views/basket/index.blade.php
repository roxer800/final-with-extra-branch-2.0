@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mx-5">
            @foreach ($products as $product)
                <div class="col col-lg-3 col-md-4 col-sm-6 my-3 gx-2">
                    <div class="card" style="width: 18rem;">
                        <img class="image" src="{{ asset('storage/' . $product->main_photo) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p>{{ $product['price'] }} ლარი</p>
                            <div>
                                <h5>კატეგორია:</ჰ>
                                    <p>{{ $product['category'] }}</p>
                            </div>
                            <a href="{{ route('product.show', ['product' => $product]) }}" class="btn btn-primary">პროდუქტის
                                ნახვა</a>

                            <form action="{{ route('basket.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmDelete()" type="submit" class="btn btn-danger mt-3">პროდუქტის
                                    წაშლა</button>
                            </form>


                        </div>
                    </div>
                </div>
            @endforeach
            <button class=" my-5 mx-5 btn btn-success">
                <a style="color: black" href="{{ route('order.create') }}">შეკვეთის დასრულება</a>
            </button>
        </div>
    </div>
@endsection
