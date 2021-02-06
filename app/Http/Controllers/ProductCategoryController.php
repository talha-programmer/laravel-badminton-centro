<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = ProductCategory::with('products')->paginate(10);
        return view('product_category.index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $categoryId = $request->category;
        $category = null;
        if($categoryId){
            $category = ProductCategory::find($categoryId);
        }else{
            $category = new ProductCategory();
        }

        $category->name = $request->name;
        $category->save();

        return back()->with('info', 'Product Category saved successfully!');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return back()->with('info', 'Category deleted successfully!');
    }


}
