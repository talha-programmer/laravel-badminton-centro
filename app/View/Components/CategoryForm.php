<?php

namespace App\View\Components;

use App\Models\ProductCategory;
use Illuminate\View\Component;

class CategoryForm extends Component
{
    public $category;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ProductCategory $category = null)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.category-form');
    }
}
