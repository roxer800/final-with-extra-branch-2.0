@extends('layouts.app')

@section('content')
    <h3>adminPanel</h3>
    <div>
        <h4 class="mt-3">სულ პროდუქტი:{{ $length }}</h4>
        <h4 class="mt-3">შეკვეთების ჯამური ფასი: {{ $total }} ლარი</h4>
        <h4 class="mt-3">დასრულებული შეკვეთების ჯამური ფასი: {{ $total }} ლარი</h4>
        <h4 class="mt-3">მიმდინარე შეკვეთების რაოდენობა: {{ $ordersQuantity }}</h4>
        <h4 class="mt-3">დადასტურებული შეკვეთების რაოდენობა: {{ $approvedOrders }}</h4>
        <h4 class="mt-3">დასრულებული შეკვეთების რაოდენობა: {{ $finishedOrdersCount }}</h4>
        <h4 class="mt-3">უარყოფილი შეკვეთების რაოდენობა: {{ $rejectedOrders }}</h4>
    </div>
    @foreach ($orders as $order)
        <h5 class="mt-5">კლიენტის სახელი {{ $userName }}</h5>
        <h5 class="mt-4">შეკვეთის ID: {{ $order->id }}</h5>
        <form action="{{ route('order.update', $order->id) }}"enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class=" my-4form-group">
                <label class="my-2" for="status">შეკვეთის სტატუსი:</label>
                <select name="status" class="form-control " required>
                    <option value="{{ $order->status }}">{{ $order->status }}</option>
                    <option style="color: black" value="accepted">accepted</option>
                    <option style="color: black" value="finished">finished</option>
                    <option style="color: black" value="rejected">rejected</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">სტატუსის განახლება</button>
                <button type="button" class="btn btn-primary mt-3"><a style="color: white"
                        href="{{ route('order.show', ['order' => $order]) }}">შეკვეთის
                        დეტალები</a></button>
            </div>
        </form>
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
    {{ $ordersPaginate->onEachSide(2)->links() }}
@endsection
