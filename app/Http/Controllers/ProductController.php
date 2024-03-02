<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function products() 
    {
        return response()->json(Products::with('categories:category_name')
        ->get()->map(function ($product) {
            $categories = $product->categories->pluck('category_name');
        
            $formattedCategories = $categories->count() === 1 ? $categories->first() : $categories;
        
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'stock_quantity' => $product->stock_quantity,
                'description' => $product->description,
                'category_name' => $formattedCategories
            ];
        }));
    }

    function product($id) 
    {
        return response()->json(Products::select('id', 'product_name', 'description', 'price', 'stock_quantity')
        ->with('categories:category_name')
        ->find($id));
    }
}
