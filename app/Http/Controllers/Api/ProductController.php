<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll(Request $request)
    {
        $name = $request->get('name');

        $products = Product::orderBy('id', 'desc')
            ->name($name)
            ->paginate();

        return response()->json($products);
    }
}
