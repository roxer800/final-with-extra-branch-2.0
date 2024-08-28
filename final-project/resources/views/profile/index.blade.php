@extends('layouts.app')







@section('content')
    <h3 class="mt-4">პროფილის გვერდი</h3>

    <h4 class="mt-4">ჩემი შეკვეთები</h4>

    @foreach ($orders as $order)
        <h5 class="mt-4">შეკვეთის ID: {{ $order->id }}</h5>
        <h5>შეკვეთის სტატუსი: {{ $order->status }}</h5>
        <table class="mt-2 table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">პროდუქტის სახელი</th>
                    <th scope="col">პროდუქტის რაოდენობა</th>
                    <th scope="col">პროდუქტის ფასი</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($order->items, true) as $item)
                    <tr>
                        <th scope="row">{{ $item['products_id'] }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endsection
