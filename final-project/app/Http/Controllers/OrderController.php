<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Basket;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $basket = Basket::where('users_id', $userId)->where('status', 'active')->first();

        $items = json_decode($basket->items, true);

        $total = 0;
        $quantity = 0;

        foreach ($items as $item) {
            $itemPrice = $item['price'];
            $itemQuantity = $item['quantity'];


            $total += $itemPrice;
            $quantity += $itemQuantity;
        }

        dump($quantity);




        return view('order.create', ['items' => $items, 'total' => $total, 'quantity' => $quantity]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $status = 'new';

        $basket = Basket::where('users_id', Auth::id())->first();

        Basket::where('users_id', Auth::id())->where('status', 'active')->update(['status' => 'finished']);

        $basketId = $basket->id;

        $items = $basket->items;

        dump($items);

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|min:9',
        ]);

        Orders::create([
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'users_id' => Auth::id(),
            'status' => $status,
            'basket_id' => $basketId,
            'items' => $items
        ]);

        return redirect()->route('product.index')->with('success', 'შეკვეთა წარმატებით განთავსდა');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $order = Orders::find($id);

        $userId = $order->users_id;

        $user = User::where('id', $userId)->first();

        $orderItems = json_decode($order->items, true);

        return view('order.show', ['user' => $user, 'orderItems' => $orderItems]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Orders::find($id);

        $order->update([
            'status' => $request['status'],
        ]);


        return redirect()->back()->with('success', 'order status updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
