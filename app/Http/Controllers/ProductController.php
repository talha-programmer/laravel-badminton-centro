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


    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image',
        ]);

        $product = null;
        $productId = $request->product_id;
        if($productId > 0){

            $product = Product::find($productId);

            // remove all categories of product from pivot table
            $product->categories()->detach();

        } else {
            $product = new Product();
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $image = $request->file('image');
        if($image) {

            $imageName = $product->name . time() . '.' . $image->extension();
            $image->move(public_path('images/products'), $imageName);

            // Delete existing image in case of editing the product
            $existingImageURL = $product->image_url;
            if($existingImageURL){
                unlink(public_path() . '/' . $existingImageURL);
            }

            $product->image_url = "images/products/{$imageName}";
        }
        $product->save();

        $categories = $request->categories;
        if($categories != null)
        {
            foreach ($categories as $category){
                $category = ProductCategory::find($category);
                $category->products()->save($product);
            }
        }

        return back()->with('info', 'Product saved successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('info', 'Product deleted successfully!');
    }

    public function destroyImage(Product $product)
    {
        $imageURL = $product->image_url;
        if($imageURL){
            unlink(public_path() . '/' . $imageURL);
        }
        $product->image_url = null;
        $product->save();
        return back()->with('info', 'Image has been deleted successfully!');
    }
}
