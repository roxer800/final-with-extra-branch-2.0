@extends('layouts.app')





@section('content')
    <table class=" mt-5 table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">პროდუქტის სახელი</th>
                <th scope="col">პროდუქტის რაოდენობა</th>
                <th scope="col">პროდუქტის ფასი</th>
            </tr>
        </thead>
        <tbody>
            @isset($items)
                @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $item['products_id'] }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>

    <div>

        <form action="{{ route('order.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">ტელეფონი:</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">მისამართი:</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <h2>რაოდენობა:</h2>
                <input hidden type="text" name="quantity" class="form-control" value="{{ $quantity }}" required>
                <h4>{{ $quantity }}</h4>
            </div>
            <div class="form-group">
                <h4>სულ გადასახდელი თანხა:</h4>
                <input hidden type="text" name="total_price" class="form-control" value="{{ $total }}" required>
                <h2>{{ $total }} ლარი</h2>
            </div>
            <button type="submit" class=" my-3 btn btn-success">Add Product</button>
        </form>
    </div>
@endsection
