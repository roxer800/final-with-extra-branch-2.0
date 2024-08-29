<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function index()
    {
        $products = Product::get();

        $basket = Basket::where('status', 'finished')->get();

        $orders = Orders::get();

        $ordersPaginate = Orders::paginate(60);

        $length = $products->count();


        $ordersQuantity = Orders::where('status', ['accepted', 'new'])->count();



        $approvedOrders = Orders::where('status', 'accepted')->count();

        $finishedOrders = Orders::where('status', 'finished');

        $finishedOrdersCount = $finishedOrders->count();


        $rejectedOrders = Orders::where('status', 'rejected')->count();

        $total = 0;

        $userId = '';


        $info = [
            'basket' => $basket,
            'orders' => $orders,
            'length' => $length,
            'total' => $total,
            'ordersQuantity' => $ordersQuantity,
            'approvedOrders' => $approvedOrders,
            'finishedOrdersCount' => $finishedOrdersCount,
            'rejectedOrders' => $rejectedOrders,
        ];

        foreach ($info as $key => $value) {
            Cache::put($key, $value, now()->addMinutes(30));
        }

        $value = Cache::get('key');

        foreach ($basket as $basketItems) {
            $items = json_decode($basketItems->items, true);
            $userId = $basketItems->users_id;
            foreach ($items as $item) {
                $itemPrice = $item['price'];
                $itemQuantity = $item['quantity'];

                $total += $itemPrice * $itemQuantity;
            }
        }

        $user = User::where('id', $userId)->first();

        $userName = $user->name;




        return view('admin.index', ['length' => $length, 'total' => $total, 'ordersQuantity' => $ordersQuantity, 'approvedOrders' => $approvedOrders, 'finishedOrdersCount' => $finishedOrdersCount, 'rejectedOrders' => $rejectedOrders, 'orders' => $orders, "ordersPaginate" => $ordersPaginate, 'userName' => $userName]);
    }
}
