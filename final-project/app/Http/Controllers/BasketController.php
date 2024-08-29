<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Basket;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $basket = Basket::where('users_id', $userId)->where('status', 'active')->first();

        $items = $basket ? json_decode($basket->items, true) : [];

        $products = [];

        if ($basket) {
            $items = json_decode($basket->items, true);

            $productIds = array_column($items, 'products_id');

            $products = Product::whereIn('id', $productIds)->get();
        }

        dump($products);

        return view('basket.index', ['products' => $products, 'basket' => $basket]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $productsId)
    {
        $userId = Auth::id();

        $basket = Basket::where('users_id', $userId)->where('status', 'active')->first();


        $items = json_decode($basket->items, true);


        $filteredItems = [];

        foreach ($items as $item) {
            if ($item['products_id'] != $productsId) {
                $filteredItems[] = $item;
            }
        }

        $items = $filteredItems;



        $basket->items = json_encode($items);
        $basket->save();


        return redirect()->back()->with('error', 'წარმატებით წაიშალა.');
    }

    public function addToBasket(Request $request, $productsId)
    {
        $userId = Auth::id();
        $product = Product::find($productsId);
        $price = $product->price;
        $quantity = $request->input('quantity', 1);


        $basket = Basket::firstOrNew(
            ['users_id' => $userId, 'status' => 'active'],
        );

        if (!$basket->exists) {
            $basket->save();
        }

        $items = $basket->items ? json_decode($basket->items, true) : [];

        $productExists = false;

        foreach ($items as &$item) {
            if ($item['products_id'] == $productsId) {
                $item['quantity'] += $quantity;
                $item['price'] = $price * $item['quantity'];
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $items[] = [
                'products_id' => $product->id,
                'title' => $product->title,
                'quantity' => $quantity,
                'price' => $price * $quantity,
            ];
        }

        $basket->items = json_encode($items);
        $basket->save();

        return redirect()->route('product.index')->with('success', 'Product added successfully');
    }
}
