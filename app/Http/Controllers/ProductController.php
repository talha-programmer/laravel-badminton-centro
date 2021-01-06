<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index',[
            'products' => $products,
        ]);
    }

    public function addProduct()
    {
        $categories= ProductCategory::all();
        return view('product.add_product', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $product = new Product([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,

        ]);
        $product->save();

        if($request->category > 0)
        {
            $category = ProductCategory::find($request->category);
            $category->products()->save($product);
        }

        return back()->with('status', 'Product saved successfully!');
    }
}
