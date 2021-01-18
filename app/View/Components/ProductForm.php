<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\Component;

class ProductForm extends Component
{
    public $product = null;
    public $categories = null;
    public $selectedCategories = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product = null)
    {
        $this->product = $product;
        $this->categories = ProductCategory::all();

        if($product->id !=null){
            $this->selectedCategories = array();
            foreach ($product->categories as $category){
                array_push($this->selectedCategories, $category->id);
            }

        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product-form');
    }

    public function displayProductId()
    {
        if($this->product == null){
            return "";
        }
        return "_product_" . $this->product->id;
    }
}
