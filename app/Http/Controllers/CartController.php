<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    function addCart(Request $request) {
        $cart_deatils = request(['product_id', 'quantity']);

        $cart_deatils['user_id'] = auth()->user()->id;

        Cart::create($cart_deatils);

        return response()->json([
            'status_code' => 200,
            'message' => 'Added cart successfully'
        ]);
    }

    function getCart() {
        $user_id = auth()->user()->id;
        $userCarts = Cart::where('user_id', $user_id)
            ->with([
                'product.categories' => function ($query) {
                    $query->select('category_name');
                }
            ])
            ->get(['quantity', 'product_id']);

        // Transform the result to a flat structure
        $userCarts = $userCarts->map(function ($cart) {
            $product = $cart->product->toArray();
            unset ($product['id'], $product['created_at'], $product['updated_at']);

            // Check if categories exist and transform them if they do
            if (isset ($product['categories']) && is_array($product['categories'])) {
                $categories = collect($product['categories'])->pluck('category_name')->toArray();
                $product['categories'] = $categories;
            }

            $cart->product = $product;
            return $cart;
        });



        return response()->json($userCarts);
    }
}
