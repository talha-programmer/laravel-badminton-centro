<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('product_category.index', [
            'categories' => $categories,
        ]);
    }

    public function addCategory()
    {
        return view('product_category.add_category');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        ProductCategory::create($request->only('name'));

        return back()->with('status', 'Product Category saved successfully!');
    }
}
