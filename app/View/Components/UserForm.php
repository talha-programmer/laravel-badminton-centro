<?php

namespace App\View\Components;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\Component;

class UserForm extends Component
{
    public $user;

    /**
     * Create a new component instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user-form');
    }

    public function userId()
    {
        if($this->user->id != null){
            return '_user_' . $this->user->id;
        }
        return null;
    }
}
