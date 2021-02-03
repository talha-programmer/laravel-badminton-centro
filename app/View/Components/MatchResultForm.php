<?php

namespace App\View\Components;

use App\Models\Match;
use Illuminate\View\Component;

class MatchResultForm extends Component
{
    public $match;
    /**
     * Create a new component instance.
     *
     * @param Match $match
     */
    public function __construct(Match $match)
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
        return view('components.match-result-form');
    }
}
