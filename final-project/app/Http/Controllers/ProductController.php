<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::get();

        $deadline = Carbon::now()->subDays(10);

        $featuredProducts = Product::where('created_at', ">=", $deadline)->orderBy('id', 'desc')->take(10)->get();

        $productsPaginate = Product::paginate(24);




        $id = Auth::id();

        $user = User::where('id', $id)->first();

        $basketLength = Basket::where('users_id', Auth::id())->count();





        return view('product.index', ["products" => $products, "basketLength" => $basketLength, 'user' => $user, 'productsPaginate' => $productsPaginate, 'featuredProducts' => $featuredProducts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'category' => 'required|string|max:255',
        ]);


        $userId = Auth::id();



        Product::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'users_id' => $userId,
            'main_photo' => $request->file('main_photo')->store('photos', 'public'),
            'additional_photo_1' => $request->file('additional_photo_1')->store('photos', 'public'),
            'additional_photo_2' => $request->file('additional_photo_2')->store('photos', 'public'),
            'additional_photo_3' => $request->file('additional_photo_3')->store('photos', 'public'),
            'additional_photo_4' => $request->file('additional_photo_4')->store('photos', 'public'),
        ]);


        return redirect()->back()->with('success', 'Product created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id);

        $user = Auth::user();

        return view('product.show', ['products' => $products, 'user' => $user]);
    }


    public function edit(Product $product)


    {


        $categories = Categories::all();

        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'category' => 'required|string|max:255',

        ]);

        $product = Product::find($id);



        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
        ]);


        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {


        $product->delete();

        $products = Product::get();
        $user = Auth::user();
        $basketLength = Basket::where('users_id', $user)->count();

        return redirect()->route('product.index')->with('error', 'Product deleted');
    }
}
