<?php

namespace App\View\Components;

use App\Models\News;
use Illuminate\View\Component;

class NewsForm extends Component
{
    public $news = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(News $news = null)
    {
        $this->news = $news;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.news-form');
    }


    public function displayNewsId()
    {
        if($this->news == null){
            return "";
        }
        return "_news_" . $this->news->id;
    }
}
