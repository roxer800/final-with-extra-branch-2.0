<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelController extends Controller
{
    public function index(Request $request)
    {

        $authorizationHeader = $request->header('Authorization');

        $token = substr($authorizationHeader, 7);
        $account = User::where('token', $token)->first();

        if (!$account) {
            return response()->json(['error' => 'Unauthorized: Token missing or invalid']);
        }

        $Product = Product::all();

        return response()->json($Product);
    }
    public function show($id)
    {
        $Product = Product::find($id);

        return response()->json($Product);
    }
}
