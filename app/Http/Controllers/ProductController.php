<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')
            ->name($request->get('name'))
            ->paginate();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->createNewProduct($request);
        return redirect(route('products.index'));
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $product->updateProduct($request);
        return redirect(route('products.index'));
    }


}
