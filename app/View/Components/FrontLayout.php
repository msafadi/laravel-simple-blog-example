<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title;

    public $home;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $home = false)
    {
        $this->title = $title;
        $this->home = $home;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
