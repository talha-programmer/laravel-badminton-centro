<?php

namespace App\View\Components;

use App\Models\Order;
use App\Services\CartServices;
use Illuminate\View\Component;

class OrderForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.order-form');
    }
}
