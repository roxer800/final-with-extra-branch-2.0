@extends('layouts.app')


@section('content')
    <h4>კლიენტის დეტალები</h4>
    <table class="mt-2 table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">კლიენტის სახელი</th>
                <th scope="col">კლიენტის იმეილი</th>
                <th scope="col">კლიენტის ტელეფონის ნომერი</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $user['id'] }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone_number'] }}</td>
            </tr>
        </tbody>
    </table>

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
            @foreach ($orderItems as $orderItem)
                <tr>
                    <th scope="row">{{ $orderItem['products_id'] }}</th>
                    <td>{{ $orderItem['title'] }}</td>
                    <td>{{ $orderItem['quantity'] }}</td>
                    <td>{{ $orderItem['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
