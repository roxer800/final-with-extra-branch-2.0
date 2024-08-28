@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>{{ $category->title }}</h1>
        <p>{{ $category->description }}</p>


        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="image" src="{{ asset('storage/' . $product->main_photo) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price: </strong>{{ $product->price }}</p>
                            <a href="{{ route('product.show', ['product' => $product]) }}""
                                class="btn btn-primary">პროდუქტის ნახვა</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->onEachSide(2)->links() }}


    </div>
@endsection
