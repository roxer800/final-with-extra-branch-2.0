@extends('layouts.app')




@section('content')
    <div class="container my-5">
        @csrf
        <div class="row">
            <div class="col-3 pictures-section">
                @foreach (['additional_photo_1', 'additional_photo_2', 'additional_photo_3', 'additional_photo_4'] as $photo)
                    @if ($products->$photo)
                        <img class="additional-image" src="{{ asset('storage/' . $products->$photo) }}" alt="...">
                    @endif
                @endforeach
            </div>
            <div class="col-4 picture-section">
                <img class="image" src="{{ asset('storage/' . $products->main_photo) }}" alt="...">
            </div>
            <div class="col-5 description">
                <h4 class="mt-4 mx-4">{{ $products['title'] }}</h4>
                <p class="mt-4 mx-4">{{ $products['description'] }}</p>
                <p class="mt-4 mx-4"> {{ $products['price'] }} ლარი</p>
                <div class="mt-4 mx-4">
                    <h5>კატეგორია:</h5>
                    <p>{{ $products['category'] }}</p>
                </div>
                @auth
                    @if (Auth::id() != $products->users_id)
                        <form action="{{ route('basket.add', $products->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary mt-4 mx-4" type="submit">კალათაში დამატება</button>
                        </form>
                    @else
                        <form action="/product/{{ $products['id'] }}" method="POST">
                            @method('delete')
                            @csrf
                            <button onclick="confirmDelete()" type="submit" class="btn btn-danger">პროდუქტის წაშლა</button>
                        </form>
                        <button class="my-3 btn btn-primary">
                            <a style="color:white" href="{{ route('product.edit', ['product' => $products['id']]) }}">პროდუქტის
                                რედაქტირება</a>
                        </button>
                    @endif
                @endauth
                @guest
                    <a onclick="handleAddToBasket()" class="btn btn-primary mt-4 mx-4">კალათაში დამატება</a>
                @endguest
            </div>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this?');
        }

        function handleAddToBasket() {
            alert("Please log in to add product to your basket.");
        }
    </script>
@endsection
