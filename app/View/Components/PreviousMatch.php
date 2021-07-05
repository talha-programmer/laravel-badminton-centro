<?php

namespace App\View\Components;

use App\Models\Match;
use Illuminate\View\Component;

class PreviousMatch extends Component
{
    public $match;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($match = null)
    {
        $this->match = $match;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.previous-match');
    }
}
