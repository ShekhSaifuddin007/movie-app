<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvShowsCard extends Component
{
    public $tv;

    /**
     * Create a new component instance.
     *
     * @param $tv
     */
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tv-shows-card');
    }
}
