<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Supplier;
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
        $categories = Category::get();
        $suppliers = Supplier::get();

        return view('products.create', compact('categories', 'suppliers'));
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
        $categories = Category::get();
        $suppliers = Supplier::get();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $product->updateProduct($request);
        return redirect(route('products.index'));
    }


}
